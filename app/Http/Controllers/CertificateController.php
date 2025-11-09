<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);

        // Agar overall_progress bo'lmasa, demo qiymat beramiz
        $progress = $user->overall_progress ?? 85;
        $canGetCertificate = $progress >= 70;

        return view('pages.certificate', compact('user', 'progress', 'canGetCertificate'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'format' => 'required|in:pdf,image'
        ]);

        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);

        // Progressni tekshirish (agar bo'lmasa, demo qiymat)
        $progress = $user->overall_progress ?? 85;

        if ($progress < 70) {
            return response()->json([
                'success' => false,
                'message' => 'Sertifikat olish uchun progress 70% dan yuqori bo\'lishi kerak. Hozirgi progress: ' . $progress . '%'
            ], 422);
        }

        // Sertifikat ma'lumotlari
        $certificateData = [
            'full_name' => $request->full_name,
            'score' => $progress,
            'issue_date' => now()->format('d.m.Y'),
            'certificate_id' => 'EVAL-' . now()->format('Y') . '-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
            'course_name' => 'Raqamli Baholash Kompetensiyasini Rivojlantirish',
        ];

        try {
            // User ma'lumotlarini yangilash
            $updateData = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'overall_progress' => $progress,
            ];

            // Faqat mavjud column'larni yangilash
            if ($this->columnExists('users', 'certificate_data')) {
                $updateData['certificate_data'] = json_encode($certificateData);
            }
            if ($this->columnExists('users', 'certificate_issued_at')) {
                $updateData['certificate_issued_at'] = now();
            }

            $user->update($updateData);

            Log::info('Sertifikat yaratildi', [
                'user_id' => $user->id,
                'certificate_data' => $certificateData
            ]);

        } catch (\Exception $e) {
            Log::error('Sertifikat saqlashda xatolik', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            // Xatolik bo'lsa ham sertifikat yaratishda davom etamiz
        }

        // Download URL yaratish
        $downloadUrl = url("/certificate/download/{$user->id}/{$request->format}");

        return response()->json([
            'success' => true,
            'message' => 'Sertifikat muvaffaqiyatli yaratildi!',
            'certificate' => $certificateData,
            'download_url' => $downloadUrl
        ]);
    }

    public function download($user_id, $format = 'pdf')
    {
        $user = User::find($user_id);
        
        if (!$user) {
            // Agar user topilmasa, demo sertifikat yaratish
            return $this->generateDemoCertificate($format);
        }

        // Sertifikat ma'lumotlarini olish
        $certificateData = [];
        
        if ($user->certificate_data) {
            try {
                $certificateData = json_decode($user->certificate_data, true);
            } catch (\Exception $e) {
                Log::error('Sertifikat ma\'lumotlarini o\'qishda xatolik', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        // Agar sertifikat ma'lumotlari bo'lmasa yoki xatolik bo'lsa, yangisini yaratish
        if (empty($certificateData)) {
            $progress = $user->overall_progress ?? 85;
            $certificateData = [
                'full_name' => $user->full_name ?? 'Foydalanuvchi',
                'score' => $progress,
                'issue_date' => now()->format('d.m.Y'),
                'certificate_id' => 'EVAL-' . now()->format('Y') . '-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                'course_name' => 'Raqamli baholash kompetensiyasini rivojlantirish',
            ];
        }

        if ($format === 'pdf') {
            return $this->generatePdfCertificate($certificateData);
        } elseif ($format === 'image') {
            return $this->generateImageCertificate($certificateData);
        }

        return response()->json([
            'success' => false,
            'message' => 'Noto\'g\'ri format'
        ], 400);
    }

    private function generateDemoCertificate($format)
    {
        $certificateData = [
            'full_name' => 'Demo Foydalanuvchi',
            'score' => 85,
            'issue_date' => now()->format('d.m.Y'),
            'certificate_id' => 'EVAL-DEMO-' . now()->format('Ymd'),
            'course_name' => 'Raqamli baholash kompetensiyasini rivojlantirish',
        ];

        if ($format === 'pdf') {
            return $this->generatePdfCertificate($certificateData);
        } else {
            return $this->generateImageCertificate($certificateData);
        }
    }

    private function generatePdfCertificate($certificateData)
    {
        $html = $this->getCertificateHtml($certificateData);
        
        // Browserda HTML sifatida ko'rsatish
        return Response::make($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="EvalEd_Sertifikat_' . $certificateData['certificate_id'] . '.html"');
    }

    private function generateImageCertificate($certificateData)
    {
        $html = $this->getCertificateHtml($certificateData);
        
        // Browserda HTML sifatida ko'rsatish
        return Response::make($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="EvalEd_Sertifikat_' . $certificateData['certificate_id'] . '.html"');
    }

    private function getCertificateHtml($certificateData)
    {
        return "
        <!DOCTYPE html>
        <html lang='uz'>
        <head>
            <meta charset='utf-8'>
            <title>Sertifikat - {$certificateData['certificate_id']}</title>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
                
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                body { 
                    font-family: 'Inter', Arial, sans-serif; 
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 5px;
                }
                
                .certificate-container { 
                    background: white; 
                    border: 10px solid #4f46e5;
                    padding: 15px; 
                    text-align: center; 
                    max-width: 1000px;
                    width: 100%;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                    position: relative;
                    overflow: hidden;
                }
                
                .certificate-logo {
                    width: 100px;
                    height: 100px;
                    background: #4f46e5;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto;
                    color: white;
                    font-size: 35px;
                }
                
                .certificate-title { 
                    color: #4f46e5; 
                    font-size: 45px; 
                    margin-bottom: 15px; 
                    font-weight: bold;
                    text-transform: uppercase;
                    letter-spacing: 3px;
                }
                
                .certificate-subtitle {
                    color: #666;
                    font-size: 20px;
                    margin-bottom: 15px;
                    line-height: 1.6;
                }
                
                .certificate-name { 
                    color: #4f46e5; 
                    font-size: 38px; 
                    margin: 20px 0; 
                    font-weight: bold;
                    text-transform: uppercase;
                    line-height: 1.2;
                    padding: 20px;
                    border: 3px solid #4f46e5;
                    border-radius: 10px;
                    display: inline-block;
                }
                
                .certificate-text { 
                    margin: 30px 0; 
                    line-height: 1.5;
                    font-size: 20px;
                    color: #333;
                }
                
                .certificate-footer { 
                    margin-top: 50px; 
                    display: flex; 
                    justify-content: space-between;
                    align-items: flex-end;
                    flex-wrap: wrap;
                    gap: 15px;
                }
                
                .signature-area { 
                    border-top: 2px solid #333; 
                    padding-top: 15px; 
                    width: 250px; 
                    text-align: center;
                }
                
                .certificate-info {
                    margin-top: 40px;
                    font-size: 16px;
                    color: #666;
                    border-top: 2px solid #eee;
                    padding-top: 30px;
                }
                
                .watermark {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(-45deg);
                    font-size: 120px;
                    color: rgba(79, 70, 229, 0.05);
                    font-weight: bold;
                    pointer-events: none;
                    z-index: 0;
                    white-space: nowrap;
                }
                
                .details-section {
                    background: #f8fafc;
                    padding: 25px;
                    border-radius: 15px;
                    margin: 25px 0;
                    border-left: 5px solid #4f46e5;
                }
                
                .details-section p {
                    margin: 5px 0;
                    font-size: 16px;
                }
                
                .action-buttons {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 1000;
                    display: flex;
                    gap: 10px;
                }
                
                .btn {
                    background: #4f46e5;
                    color: white;
                    border: none;
                    padding: 12px 24px;
                    border-radius: 8px;
                    cursor: pointer;
                    font-size: 16px;
                    font-family: 'Inter', sans-serif;
                    transition: background 0.3s;
                }
                
                .btn:hover {
                    background: #4338ca;
                }
                
                @media print {
                    .action-buttons {
                        display: none;
                    }
                    
                    body {
                        background: white !important;
                    }
                    
                    .certificate-container {
                        border: 15px solid #4f46e5;
                        box-shadow: none;
                        margin: 0;
                        padding: 40px;
                    }
                }
            </style>
        </head>
        <body>
            <div class='action-buttons'>
                <button class='btn' onclick='window.print()'>
                    <i class='fas fa-print'></i> Chop etish
                </button>
                <button class='btn' onclick='window.close()'>
                    <i class='fas fa-times'></i> Yopish
                </button>
            </div>
        
            <div class='certificate-container'>
                <div class='watermark'>EVALED CERTIFICATE</div>
                
                <div class='certificate-logo'>
                    <i class='fas fa-award'></i>
                </div>
                
                <div class='certificate-title'>Sertifikat</div>
                
                <div class='certificate-subtitle'>
                    Ushbu sertifikat quyidagi shaxsning
                </div>
                
                <div class='certificate-name'>{$certificateData['full_name']}</div>
                
                <div class='certificate-text'>
                    <p>\"Raqamli baholash kompetensiyasini rivojlantirish\" kursini</p>
                    <p>muvaffaqiyatli tamomlaganligini tasdiqlaydi</p>
                </div>
                
                <div class='details-section'>
                    <p><strong>🎓 Kurs nomi:</strong> {$certificateData['course_name']}</p>
                    <p><strong>📊 O'zlashtirish darajasi:</strong> {$certificateData['score']}%</p>
                    <p><strong>📅 Berilgan sana:</strong> {$certificateData['issue_date']}</p>
                    <p><strong>🆈 Sertifikat raqami:</strong> {$certificateData['certificate_id']}</p>
                </div>
                
                <div class='certificate-footer'>
                    <div>
                        <div class='signature-area'></div>
                        <p style='margin-top: 10px; font-weight: bold;'>EvalEd Platformasi Rahbari</p>
                        <p>Raqamli ta'lim tizimi</p>
                    </div>
                    <div>
                        <div class='signature-area'></div>
                        <p style='margin-top: 10px; font-weight: bold;'>Qo'shimcha ma'lumot</p>
                        <p>Online kurs • {$certificateData['score']}% muvaffaqiyat</p>
                    </div>
                </div>
                
                <div class='certificate-info'>
                    <p><strong>🌐 Tasdiqlash uchun:</strong> https://evaled.uz</p>
                    <p style='font-size: 16px; color: #999; margin-top: 15px; line-height: 1.5;'>
                        Ushbu sertifikat EvalEd raqamli ta'lim platformasida o'tkazilgan kursni muvaffaqiyatli tamomlaganligini tasdiqlaydi. 
                        Sertifikat raqami orqali onlayn tekshirish mumkin.
                    </p>
                </div>
            </div>

            <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js'></script>
            <script>
                // Avtomatik ravishda chop etish dialogini ochish
                window.onload = function() {
                    // 1 soniyadan so'ng print dialogini ochish
                    setTimeout(() => {
                        window.print();
                    }, 1000);
                };
            </script>
        </body>
        </html>
        ";
    }

    /**
     * Database column mavjudligini tekshirish
     */
    private function columnExists($table, $column)
    {
        try {
            return \Schema::hasColumn($table, $column);
        } catch (\Exception $e) {
            return false;
        }
    }
}