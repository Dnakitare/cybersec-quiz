<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CybersecurityQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure clean slate for this specific seeder if run multiple times
        // Optional: Adjust based on whether you want this repeatable or additive
        // DB::table('questions')->whereIn('quiz_id', function ($query) {
        //     $query->select('id')->from('quizzes')->whereIn('category_id', function ($subQuery) {
        //         $subQuery->select('id')->from('categories')->where('name', 'Cybersecurity Awareness');
        //     });
        // })->delete();
        // DB::table('quizzes')->whereIn('category_id', function ($query) {
        //     $query->select('id')->from('categories')->where('name', 'Cybersecurity Awareness');
        // })->delete();
        // DB::table('categories')->where('name', 'Cybersecurity Awareness')->delete();

        // Create Category
        $category = Category::firstOrCreate(['name' => 'Cybersecurity Awareness']);

        // --- Quiz 1: Phishing Awareness ---
        $phishingQuiz = Quiz::create([
            'title' => 'Phishing Awareness Fundamentals',
            'category_id' => $category->id,
        ]);

        Question::create([
            'quiz_id' => $phishingQuiz->id,
            'text' => 'What is the main goal of a phishing attack?',
            'options' => json_encode([
                'A' => 'To install antivirus software',
                'B' => 'To steal sensitive information (like passwords or credit card numbers)',
                'C' => 'To provide technical support',
                'D' => 'To sell discounted products'
            ]),
            'correct_answer' => 'B'
        ]);

        Question::create([
            'quiz_id' => $phishingQuiz->id,
            'text' => 'Which of these is a common sign of a phishing email?',
            'options' => json_encode([
                'A' => 'An email from your CEO with perfect grammar',
                'B' => 'A request for personal information with a sense of urgency',
                'C' => 'A link to your company\'s official website',
                'D' => 'A generic greeting like "Dear Valued Customer"'
            ]),
            // Note: Both B and D can be signs, but B is often stronger. Adjust if needed.
            'correct_answer' => 'B'
        ]);

        Question::create([
            'quiz_id' => $phishingQuiz->id,
            'text' => 'If you suspect an email is a phishing attempt, what should you do?',
            'options' => json_encode([
                'A' => 'Click all the links to see where they go',
                'B' => 'Reply with your password to verify your identity',
                'C' => 'Delete the email and report it to your IT/Security department',
                'D' => 'Forward it to all your colleagues'
            ]),
            'correct_answer' => 'C'
        ]);


        // --- Quiz 2: Password Security ---
        $passwordQuiz = Quiz::create([
            'title' => 'Strong Password Practices',
            'category_id' => $category->id,
        ]);

        Question::create([
            'quiz_id' => $passwordQuiz->id,
            'text' => 'Which of the following is the strongest password?',
            'options' => json_encode([
                'A' => 'password123',
                'B' => 'P@$$wOrd!',
                'C' => 'correct horse battery staple', // Example of a passphrase
                'D' => 'Tr0ub4dor&3' // Example of complex but shorter
            ]),
             // C is generally recommended (passphrase), D is also strong. Let's go with C.
            'correct_answer' => 'C'
        ]);

        Question::create([
            'quiz_id' => $passwordQuiz->id,
            'text' => 'What is multi-factor authentication (MFA)?',
            'options' => json_encode([
                'A' => 'Using the same password for multiple accounts',
                'B' => 'A password that includes multiple types of characters',
                'C' => 'An extra layer of security requiring more than just a password (e.g., code from phone)',
                'D' => 'Changing your password frequently'
            ]),
            'correct_answer' => 'C'
        ]);

         Question::create([
            'quiz_id' => $passwordQuiz->id,
            'text' => 'Is it safe to share your work password with a trusted colleague?',
            'options' => json_encode([
                'A' => 'Yes, if they promise not to misuse it',
                'B' => 'Yes, but only verbally, not in writing',
                'C' => 'No, passwords should never be shared',
                'D' => 'Only if your manager approves it'
            ]),
            'correct_answer' => 'C'
        ]);

        // --- Quiz 3: Malware Protection ---
        $malwareQuiz = Quiz::create([
            'title' => 'Understanding Malware Threats',
            'category_id' => $category->id,
        ]);

        Question::create([
            'quiz_id' => $malwareQuiz->id,
            'text' => 'What is ransomware?',
            'options' => json_encode([
                'A' => 'Software that speeds up your computer',
                'B' => 'Malware that blocks access to data until a ransom is paid',
                'C' => 'A type of antivirus program',
                'D' => 'A tool for securely deleting files'
            ]),
            'correct_answer' => 'B'
        ]);

        Question::create([
            'quiz_id' => $malwareQuiz->id,
            'text' => 'How can you best protect your computer from malware?',
            'options' => json_encode([
                'A' => 'Only visiting websites you know',
                'B' => 'Installing reputable antivirus software and keeping it updated',
                'C' => 'Never downloading any files from the internet',
                'D' => 'Ignoring software update notifications'
            ]),
            'correct_answer' => 'B'
        ]);

        Question::create([
            'quiz_id' => $malwareQuiz->id,
            'text' => 'What should you do if you suspect your work computer is infected with malware?',
            'options' => json_encode([
                'A' => 'Try to remove it yourself using free online tools',
                'B' => 'Immediately disconnect from the network and contact IT/Security',
                'C' => 'Restart the computer several times',
                'D' => 'Ignore it, the antivirus will eventually catch it'
            ]),
            'correct_answer' => 'B'
        ]);

        // --- Quiz 4: Social Engineering ---
        $socialEngQuiz = Quiz::create([
            'title' => 'Recognizing Social Engineering',
            'category_id' => $category->id,
        ]);

        Question::create([
            'quiz_id' => $socialEngQuiz->id,
            'text' => 'What is "tailgating" or "piggybacking" in a physical security context?',
            'options' => json_encode([
                'A' => 'Following someone closely to get through a secure door without authorization',
                'B' => 'Attending a company picnic',
                'C' => 'Sharing snacks with colleagues',
                'D' => 'Using a company vehicle for personal errands'
            ]),
            'correct_answer' => 'A'
        ]);

        Question::create([
            'quiz_id' => $socialEngQuiz->id,
            'text' => 'An urgent email asks for your password to perform a system upgrade. This is likely:',
            'options' => json_encode([
                'A' => 'A legitimate request from IT',
                'B' => 'A standard security procedure',
                'C' => 'A phishing attempt (a form of social engineering)',
                'D' => 'A system error message'
            ]),
            'correct_answer' => 'C'
        ]);

        Question::create([
            'quiz_id' => $socialEngQuiz->id,
            'text' => 'What is "pretexting"?',
            'options' => json_encode([
                'A' => 'Sending a text message before calling someone',
                'B' => 'Creating a fabricated scenario (pretext) to gain trust and information',
                'C' => 'Writing the introduction to a report',
                'D' => 'Using secure communication channels'
            ]),
            'correct_answer' => 'B'
        ]);

        // --- Quiz 5: Data Handling & Privacy ---
        $dataQuiz = Quiz::create([
            'title' => 'Secure Data Handling Practices',
            'category_id' => $category->id,
        ]);

        Question::create([
            'quiz_id' => $dataQuiz->id,
            'text' => 'What is considered Sensitive Personal Information (SPI / PII)?',
            'options' => json_encode([
                'A' => 'Publicly available company addresses',
                'B' => 'Employee names listed on the company website',
                'C' => 'Information like SSN, bank account numbers, health records',
                'D' => 'General customer feedback'
            ]),
            'correct_answer' => 'C'
        ]);

        Question::create([
            'quiz_id' => $dataQuiz->id,
            'text' => 'How should sensitive documents be disposed of when no longer needed?',
            'options' => json_encode([
                'A' => 'Thrown in the regular trash bin',
                'B' => 'Recycled with other paper documents',
                'C' => 'Securely shredded or incinerated',
                'D' => 'Left on your desk for cleaning staff'
            ]),
            'correct_answer' => 'C'
        ]);

         Question::create([
            'quiz_id' => $dataQuiz->id,
            'text' => 'Is it acceptable to use public Wi-Fi (e.g., at a coffee shop) to access sensitive company data?',
            'options' => json_encode([
                'A' => 'Yes, public Wi-Fi is generally secure',
                'B' => 'Only if you use a VPN (Virtual Private Network)',
                'C' => 'Yes, as long as the website uses HTTPS',
                'D' => 'No, never under any circumstances'
            ]),
             // B is the most practical and common advice for necessary remote work.
            'correct_answer' => 'B'
        ]);

        // --- Add more quizzes and questions for other topics below ---
        // e.g., Secure Browsing, Incident Response, Physical Security etc.

    }
} 