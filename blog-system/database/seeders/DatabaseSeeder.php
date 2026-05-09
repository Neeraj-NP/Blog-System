<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        DB::table('users')->insert([
            'name'       => 'Admin',
            'email'      => 'admin@blogyaari.com',
            'password'   => Hash::make('admin@123'),
            'is_admin'   => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed categories
        $categories = ['Admit Card', 'Result', 'Sarkari Job', 'Answer Key', 'Syllabus', 'Admit Card'];
        $catIds = [];
        foreach ($categories as $cat) {
            $id = DB::table('categories')->insertGetId([
                'name'       => $cat,
                'slug'       => Str::slug($cat) . '-' . rand(100,999),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $catIds[] = $id;
        }

        // Seed sample blogs
        $blogs = [
            [
                'title' => 'SSC CGL 2024 Admit Card Released – Download Now',
                'short_description' => 'Staff Selection Commission has released the admit card for SSC CGL Tier-I 2024 examination. Candidates can download their hall ticket from the official website.',
                'content' => '<p>The Staff Selection Commission (SSC) has officially released the admit cards for the Combined Graduate Level (CGL) Tier-I Examination 2024. Candidates who have registered for the examination can now download their admit cards from the official SSC website.</p><h3>How to Download</h3><ol><li>Visit the official SSC website</li><li>Click on the "Admit Card" section</li><li>Enter your registration number and date of birth</li><li>Download and print your admit card</li></ol><p>The examination is scheduled to be held from 9th to 26th September 2024. Candidates are advised to carry a valid photo ID along with the admit card on the day of the exam.</p>',
                'category_id' => $catIds[0],
            ],
            [
                'title' => 'UPSC Civil Services Result 2024 Declared',
                'short_description' => 'Union Public Service Commission has declared the final result of Civil Services Examination 2024. Check the merit list and cut-off marks here.',
                'content' => '<p>The Union Public Service Commission (UPSC) has declared the final result of the Civil Services Examination 2024. A total of 1016 candidates have been recommended for appointment to various Group A and Group B Central Services.</p><h3>Toppers List</h3><p>Aditya Srivastava has topped the examination this year followed by Animesh Pradhan and Donuru Ananya Reddy securing 2nd and 3rd positions respectively.</p><p>Candidates can check their results on the official UPSC website. The mark sheets will be made available on the website after the declaration of the final result.</p>',
                'category_id' => $catIds[1],
            ],
            [
                'title' => 'Railway RRB NTPC 2024 Notification – 11558 Vacancies',
                'short_description' => 'Indian Railways has announced 11558 vacancies for Non-Technical Popular Categories posts. Online applications are now open for eligible candidates.',
                'content' => '<p>The Railway Recruitment Board (RRB) has released the official notification for NTPC recruitment 2024. A total of 11558 vacancies have been announced for various Non-Technical Popular Categories (NTPC) posts.</p><h3>Important Dates</h3><ul><li>Application Start Date: 14 September 2024</li><li>Last Date to Apply: 13 October 2024</li><li>Exam Date: To be announced</li></ul><h3>Eligibility</h3><p>Candidates must have passed 12th standard or hold a graduation degree depending on the post applied for. Age limit varies between 18-33 years as per the post category.</p>',
                'category_id' => $catIds[2],
            ],
            [
                'title' => 'IBPS PO Answer Key 2024 Released – Raise Objections by 5 Nov',
                'short_description' => 'Institute of Banking Personnel Selection has released the provisional answer key for IBPS PO Prelims 2024. Candidates can raise objections till 5th November.',
                'content' => '<p>The Institute of Banking Personnel Selection (IBPS) has released the provisional answer key for the Probationary Officer (PO) Preliminary Examination 2024. Candidates who appeared in the examination can now check and challenge the answer key.</p><h3>How to Check Answer Key</h3><ol><li>Go to the official IBPS website</li><li>Click on "CRP-PO/MT Provisional Answer Key"</li><li>Login with your registration number and password</li><li>Download the answer key PDF</li></ol><p>The objection window is open from 2nd November to 5th November 2024. Each objection requires a fee of ₹100 per question which will be refunded if the objection is found valid.</p>',
                'category_id' => $catIds[3],
            ],
            [
                'title' => 'NEET UG 2024 Syllabus – Complete Chapter-wise PDF Download',
                'short_description' => 'National Testing Agency has released the official NEET UG 2024 syllabus. Download the complete chapter-wise syllabus PDF for Physics, Chemistry and Biology.',
                'content' => '<p>The National Testing Agency (NTA) has released the official syllabus for NEET UG 2024. The syllabus covers topics from Class 11 and 12 NCERT books in Physics, Chemistry, and Biology.</p><h3>Subject-wise Syllabus</h3><h4>Physics</h4><p>Physical World and Measurement, Kinematics, Laws of Motion, Work, Energy and Power, Motion of System of Particles, Gravitation, Properties of Bulk Matter, Thermodynamics, Behaviour of Perfect Gas and Kinetic Theory, Oscillations and Waves, Electrostatics, Current Electricity, Magnetic Effects of Current and Magnetism, and more.</p><h4>Chemistry</h4><p>Basic concepts, Structure of Atom, Classification of Elements, Chemical Bonding, States of Matter, Thermodynamics, Equilibrium, Organic Chemistry, and more.</p><h4>Biology</h4><p>Diversity in Living World, Structural Organisation, Cell Structure, Plant Physiology, Human Physiology, Reproduction, Genetics and Evolution, Biology in Human Welfare, Biotechnology, Ecology.</p>',
                'category_id' => $catIds[4],
            ],
            [
                'title' => 'DRDO CEPTAM 10 Admit Card 2024 – Download Hall Ticket',
                'short_description' => 'Defence Research and Development Organisation has released the admit card for CEPTAM 10 STA-B and Technician A examination 2024.',
                'content' => '<p>The Defence Research and Development Organisation (DRDO) has released the admit card for the CEPTAM (Centre for Personnel Talent Management) 10 recruitment examination 2024. Candidates appearing for STA-B and Technician A posts can now download their hall tickets.</p><h3>Steps to Download Admit Card</h3><ol><li>Visit the official DRDO CEPTAM website</li><li>Click on "Download Admit Card" link</li><li>Enter your application number and date of birth</li><li>Your admit card will be displayed – download and print it</li></ol><h3>Exam Day Instructions</h3><p>Candidates must report to the examination centre at least 30 minutes before the scheduled time. Carry the printed admit card along with a valid government-issued photo ID proof.</p>',
                'category_id' => $catIds[5],
            ],
        ];

        foreach ($blogs as $blog) {
            DB::table('blogs')->insert([
                'title'             => $blog['title'],
                'slug'              => Str::slug($blog['title']),
                'short_description' => $blog['short_description'],
                'content'           => $blog['content'],
                'category_id'       => $blog['category_id'],
                'image'             => null,
                'is_published'      => true,
                'created_at'        => now()->subDays(rand(1, 30)),
                'updated_at'        => now(),
            ]);
        }
    }
}
