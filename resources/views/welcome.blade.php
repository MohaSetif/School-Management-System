<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css','resources/js/app.js'])

    <title>SchoolOS</title>
</head>


<body class="bg-zinc-950 text-white">


<section class="relative min-h-screen overflow-hidden bg-[#05070f]">

    <!-- Background effects -->

    <div class="absolute inset-0">

        <div class="
            absolute
            top-[-200px]
            left-1/2
            -translate-x-1/2
            w-[900px]
            h-[900px]
            rounded-full
            bg-blue-600/20
            blur-[160px]">
        </div>


        <div class="
            absolute
            bottom-0
            left-0
            w-full
            h-px
            bg-gradient-to-r
            from-transparent
            via-blue-500/50
            to-transparent">
        </div>

    </div>



    <!-- Navbar -->

    <nav class="
        relative
        z-20
        max-w-7xl
        mx-auto
        px-6
        pt-8">


        <div class="
            flex
            items-center
            justify-between
            rounded-2xl
            border
            border-white/10
            bg-white/[0.03]
            backdrop-blur-xl
            px-6
            py-4">


            <div class="
                text-xl
                font-bold
                tracking-tight">

                Campus<span class="text-blue-500">
                    MS
                </span>

            </div>



            <div class="
                hidden
                md:flex
                gap-8
                text-sm
                text-zinc-400">


                <a href="#features"
                   class="hover:text-white transition">
                    Features
                </a>


                <a href="#dashboard"
                   class="hover:text-white transition">
                    Platform
                </a>


                <a href="#security"
                   class="hover:text-white transition">
                    Security
                </a>


            </div>



            <a href="/admin"
               class="
               rounded-xl
               bg-blue-600
               px-5
               py-2.5
               text-sm
               font-medium
               hover:bg-blue-500
               transition">

                Dashboard

            </a>


        </div>


    </nav>





    <!-- Hero Content -->


    <div class="
        relative
        z-10
        max-w-7xl
        mx-auto
        px-6
        pt-28">



        <div class="
            text-center
            max-w-5xl
            mx-auto">


            <p class="
                hero-badge
                inline-flex
                items-center
                gap-2
                rounded-full
                border
                border-blue-500/30
                bg-blue-500/10
                px-5
                py-2
                text-sm
                text-blue-300">


                ✦
                School Management Platform


            </p>





            <h1 class="
                hero-title
                mt-8
                text-6xl
                md:text-8xl
                font-bold
                tracking-tight
                leading-[0.95]">


                The operating system
                <br>


                <span class="
                    bg-gradient-to-r
                    from-blue-400
                    via-cyan-300
                    to-emerald-400
                    text-transparent
                    bg-clip-text">

                    for modern schools

                </span>


            </h1>





            <p class="
                hero-description
                mt-8
                mx-auto
                max-w-2xl
                text-lg
                text-zinc-400
                leading-relaxed">


                Manage students, teachers,
                attendance, schedules and academic
                operations through one intelligent platform.


            </p>






            <div class="
                hero-actions
                mt-10
                flex
                justify-center
                gap-4
                flex-wrap">


                <a href="/admin"
                   class="
                   rounded-xl
                   bg-white
                   text-black
                   px-8
                   py-4
                   font-semibold
                   hover:scale-105
                   transition">


                    Launch Dashboard


                </a>



                <a href="#features"
                   class="
                   rounded-xl
                   border
                   border-white/10
                   bg-white/5
                   px-8
                   py-4
                   hover:bg-white/10
                   transition">


                    Explore Platform


                </a>


            </div>



        </div>






        <!-- Dashboard -->

        <div class="
            dashboard-preview
            relative
            mt-24
            mx-auto
            max-w-6xl">


            <!-- Glow -->

            <div class="
                absolute
                inset-0
                bg-blue-500/20
                blur-[100px]">
            </div>





            <div class="
                relative
                rounded-3xl
                border
                border-white/10
                bg-[#0b1120]
                shadow-2xl
                overflow-hidden">



                <!-- Browser -->


                <div class="
                    flex
                    items-center
                    gap-2
                    px-6
                    py-4
                    border-b
                    border-white/10">


                    <span class="w-3 h-3 rounded-full bg-red-400"></span>
                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                    <span class="w-3 h-3 rounded-full bg-green-400"></span>


                    <div class="
                        ml-5
                        rounded-lg
                        bg-white/5
                        px-5
                        py-2
                        text-xs
                        text-zinc-400">

                        campus.local/dashboard

                    </div>


                </div>






                <div class="
                    grid
                    lg:grid-cols-4">


                    <div class="
                        hidden
                        lg:block
                        border-r
                        border-white/10
                        p-6">


                        <div class="space-y-5 text-zinc-400 text-sm">


                            <p class="text-white">
                                Dashboard
                            </p>

                            <p>
                                Students
                            </p>

                            <p>
                                Attendance
                            </p>

                            <p>
                                Schedule
                            </p>

                            <p>
                                Reports
                            </p>


                        </div>


                    </div>






                    <div class="
                        lg:col-span-3
                        p-8">


                        <div class="
                            grid
                            md:grid-cols-3
                            gap-5">


                            <div class="
                                rounded-2xl
                                bg-white/5
                                p-6">

                                <p class="text-zinc-400">
                                    Students
                                </p>

                                <h3 class="text-4xl font-bold mt-2">
                                    1245
                                </h3>

                            </div>



                            <div class="
                                rounded-2xl
                                bg-white/5
                                p-6">

                                <p class="text-zinc-400">
                                    Attendance
                                </p>

                                <h3 class="text-4xl font-bold mt-2">
                                    96%
                                </h3>

                            </div>




                            <div class="
                                rounded-2xl
                                bg-white/5
                                p-6">

                                <p class="text-zinc-400">
                                    Teachers
                                </p>

                                <h3 class="text-4xl font-bold mt-2">
                                    86
                                </h3>

                            </div>


                        </div>





                        <div class="
                            mt-6
                            h-48
                            rounded-2xl
                            bg-gradient-to-br
                            from-blue-500/20
                            to-emerald-500/10
                            border
                            border-white/10">

                        </div>


                    </div>


                </div>


            </div>


        </div>


    </div>


</section>

<section id="features"
         class="modules-section
                py-32
                relative">


    <div class="max-w-7xl mx-auto px-6">


        <!-- Heading -->

        <div class="max-w-3xl mb-16">


            <p class="
                text-indigo-400
                uppercase
                tracking-widest
                text-sm
                font-semibold">

                Powerful modules

            </p>



            <h2 class="
                mt-4
                text-4xl
                md:text-6xl
                font-bold">


                Everything your school needs
                <span class="
                    text-zinc-500">

                    in one platform.

                </span>


            </h2>



            <p class="
                mt-6
                text-zinc-400
                text-lg">

                Manage academic operations,
                student records, attendance and
                administration from a unified system.

            </p>


        </div>





        <!-- Cards -->

        <div class="
            grid
            md:grid-cols-2
            lg:grid-cols-4
            gap-6">


            <!-- Students -->


            <div class="
                module-card
                group
                rounded-3xl
                border
                border-white/10
                bg-white/5
                backdrop-blur-xl
                p-8
                hover:border-indigo-500/50
                transition">


                <div class="
                    w-14
                    h-14
                    flex
                    items-center
                    justify-center
                    rounded-2xl
                    bg-indigo-500/20
                    mb-6">


                    <i data-lucide="users"
                       class="text-indigo-400">
                    </i>


                </div>



                <h3 class="
                    text-xl
                    font-semibold">

                    Student Management

                </h3>



                <p class="
                    mt-4
                    text-zinc-400
                    leading-relaxed">

                    Complete student profiles,
                    groups, academic information
                    and records.

                </p>


            </div>






            <!-- Attendance -->


            <div class="
                module-card
                group
                rounded-3xl
                border
                border-white/10
                bg-white/5
                backdrop-blur-xl
                p-8
                hover:border-indigo-500/50
                transition">


                <div class="
                    w-14
                    h-14
                    flex
                    items-center
                    justify-center
                    rounded-2xl
                    bg-indigo-500/20
                    mb-6">


                    <i data-lucide="clipboard-check"
                       class="text-indigo-400">
                    </i>


                </div>



                <h3 class="
                    text-xl
                    font-semibold">

                    Smart Attendance

                </h3>



                <p class="
                    mt-4
                    text-zinc-400
                    leading-relaxed">

                    Track presence,
                    absences and notifications
                    in real time.

                </p>


            </div>






            <!-- Schedule -->


            <div class="
                module-card
                group
                rounded-3xl
                border
                border-white/10
                bg-white/5
                backdrop-blur-xl
                p-8
                hover:border-indigo-500/50
                transition">


                <div class="
                    w-14
                    h-14
                    flex
                    items-center
                    justify-center
                    rounded-2xl
                    bg-indigo-500/20
                    mb-6">


                    <i data-lucide="calendar-days"
                       class="text-indigo-400">
                    </i>


                </div>



                <h3 class="
                    text-xl
                    font-semibold">

                    Scheduling

                </h3>



                <p class="
                    mt-4
                    text-zinc-400
                    leading-relaxed">

                    Organize classes,
                    teachers and weekly
                    timetables easily.

                </p>


            </div>







            <!-- Reports -->


            <div class="
                module-card
                group
                rounded-3xl
                border
                border-white/10
                bg-white/5
                backdrop-blur-xl
                p-8
                hover:border-indigo-500/50
                transition">


                <div class="
                    w-14
                    h-14
                    flex
                    items-center
                    justify-center
                    rounded-2xl
                    bg-indigo-500/20
                    mb-6">


                    <i data-lucide="bar-chart-3"
                       class="text-indigo-400">
                    </i>


                </div>



                <h3 class="
                    text-xl
                    font-semibold">

                    Reports & Analytics

                </h3>



                <p class="
                    mt-4
                    text-zinc-400
                    leading-relaxed">

                    Generate insights
                    and monitor school
                    performance.

                </p>


            </div>



        </div>


    </div>


</section>

<section class="
    dashboard-section
    py-32
    relative
    overflow-hidden">


<div class="max-w-7xl mx-auto px-6">



<div class="
    dashboard-section-content
    text-center
    max-w-3xl
    mx-auto
    mb-16">


<p class="
    text-indigo-400
    uppercase
    tracking-widest
    text-sm
    font-semibold">

    Your command center

</p>



<h2 class="
    mt-4
    text-4xl
    md:text-6xl
    font-bold">


A complete overview
of your school


</h2>



<p class="
    mt-6
    text-zinc-400
    text-lg">

Monitor students,
attendance and academic activity
from one intelligent dashboard.

</p>


</div>





<!-- Browser -->


<div class="
    dashboard-section-content
    rounded-3xl
    border
    border-white/10
    bg-zinc-900
    shadow-2xl
    overflow-hidden">





<!-- Browser header -->

<div class="
    flex
    items-center
    gap-2
    px-6
    py-4
    border-b
    border-white/10">


<span class="w-3 h-3 rounded-full bg-red-400"></span>

<span class="w-3 h-3 rounded-full bg-yellow-400"></span>

<span class="w-3 h-3 rounded-full bg-green-400"></span>


<div class="
    ml-6
    rounded-lg
    bg-white/5
    px-6
    py-2
    text-sm
    text-zinc-400">

school-management.local/admin

</div>


</div>





<div class="
    grid
    lg:grid-cols-[220px_1fr]">


<!-- Sidebar -->


<aside class="
    hidden
    lg:block
    border-r
    border-white/10
    p-6">


<h3 class="
    font-bold
    mb-8">

SchoolOS

</h3>



<nav class="space-y-5 text-zinc-400">


<div>
📊 Dashboard
</div>


<div>
👨‍🎓 Students
</div>


<div>
📝 Attendance
</div>


<div>
📅 Schedule
</div>


<div>
📈 Reports
</div>


</nav>


</aside>






<!-- Content -->


<div class="p-6">



<!-- Stats -->


<div class="
    grid
    md:grid-cols-4
    gap-5">


<div class="
    rounded-2xl
    bg-white/5
    p-6">


<p class="text-zinc-400">

Students

</p>


<h3 class="
    counter
    text-4xl
    font-bold"
    data-value="1245">

0

</h3>


</div>





<div class="
    rounded-2xl
    bg-white/5
    p-6">


<p class="text-zinc-400">

Teachers

</p>


<h3 class="
    counter
    text-4xl
    font-bold"
    data-value="86">

0

</h3>


</div>






<div class="
    rounded-2xl
    bg-white/5
    p-6">


<p class="text-zinc-400">

Attendance

</p>


<h3 class="
    text-4xl
    font-bold">

96%

</h3>


</div>






<div class="
    rounded-2xl
    bg-white/5
    p-6">


<p class="text-zinc-400">

Reports

</p>


<h3 class="
    counter
    text-4xl
    font-bold"
    data-value="42">

0

</h3>


</div>



</div>







<!-- Lower widgets -->


<div class="
    grid
    md:grid-cols-2
    gap-6
    mt-6">


<!-- Chart -->


<div class="
    rounded-2xl
    bg-white/5
    p-6">


<h3 class="
    font-semibold
    mb-6">

Attendance Overview

</h3>



<div class="
    flex
    items-end
    gap-3
    h-40">


<div class="
    w-full
    bg-indigo-500/40
    rounded-t-lg
    h-[60%]">
</div>


<div class="
    w-full
    bg-indigo-500/40
    rounded-t-lg
    h-[80%]">
</div>


<div class="
    w-full
    bg-indigo-500/40
    rounded-t-lg
    h-[45%]">
</div>


<div class="
    w-full
    bg-indigo-500/40
    rounded-t-lg
    h-[90%]">
</div>


<div class="
    w-full
    bg-indigo-500/40
    rounded-t-lg
    h-[70%]">
</div>


</div>


</div>







<!-- Activity -->


<div class="
    rounded-2xl
    bg-white/5
    p-6">


<h3 class="
    font-semibold
    mb-6">

Recent Activity

</h3>



<div class="space-y-5 text-zinc-400">


<p>
🟢 Ahmed marked attendance
</p>


<p>
📚 New student registered
</p>


<p>
📅 Schedule updated
</p>


<p>
📄 Report generated
</p>



</div>


</div>



</div>






</div>


</div>


</div>


</section>

<section class="
    roadmap-section
    py-32
    relative">


<div class="
    max-w-7xl
    mx-auto
    px-6">


<!-- Heading -->

<div class="
    max-w-3xl
    mb-20">


<p class="
    text-indigo-400
    uppercase
    tracking-widest
    text-sm
    font-semibold">

    Future ecosystem

</p>



<h2 class="
    mt-4
    text-4xl
    md:text-6xl
    font-bold">

Beyond management.
<br>

<span class="text-zinc-500">
A complete school platform.
</span>

</h2>



<p class="
    mt-6
    text-zinc-400
    text-lg">

The platform is designed to grow
with schools by introducing powerful
tools for parents, teachers and administrators.

</p>


</div>







<!-- Timeline -->


<div class="relative">


<!-- vertical line -->

<div class="
    absolute
    left-5
    top-0
    bottom-0
    w-px
    bg-white/10
    hidden
    md:block">
</div>





<div class="space-y-10">







<!-- Parent Portal -->


<div class="
    roadmap-item
    relative
    md:flex
    gap-10">


<div class="
    hidden
    md:flex
    w-10
    h-10
    rounded-full
    bg-indigo-600
    items-center
    justify-center
    z-10">


👨‍👩‍👧

</div>




<div class="
    flex-1
    rounded-3xl
    border
    border-white/10
    bg-white/5
    backdrop-blur-xl
    p-8">


<h3 class="
    text-2xl
    font-bold">

Parent Portal

</h3>



<p class="
    mt-3
    text-zinc-400">

Connect families with the school
through a dedicated parent experience.

</p>



<div class="
    mt-6
    flex
    flex-wrap
    gap-3">


<span class="feature-pill">
Attendance tracking
</span>


<span class="feature-pill">
Results access
</span>


<span class="feature-pill">
Notifications
</span>


</div>


</div>


</div>









<!-- Gradebook -->


<div class="
    roadmap-item
    relative
    md:flex
    gap-10">


<div class="
    hidden
    md:flex
    w-10
    h-10
    rounded-full
    bg-purple-600
    items-center
    justify-center
    z-10">

📝

</div>



<div class="
    flex-1
    rounded-3xl
    border
    border-white/10
    bg-white/5
    p-8">


<h3 class="
    text-2xl
    font-bold">

Advanced Gradebook

</h3>



<p class="
    mt-3
    text-zinc-400">

Move from simple results
to complete academic performance tracking.

</p>



<div class="
    mt-6
    flex
    flex-wrap
    gap-3">


<span class="feature-pill">
GPA calculation
</span>


<span class="feature-pill">
Report cards
</span>


<span class="feature-pill">
Performance analytics
</span>


</div>


</div>


</div>









<!-- Finance -->


<div class="
    roadmap-item
    relative
    md:flex
    gap-10">


<div class="
    hidden
    md:flex
    w-10
    h-10
    rounded-full
    bg-emerald-600
    items-center
    justify-center
    z-10">

💰

</div>



<div class="
    flex-1
    rounded-3xl
    border
    border-white/10
    bg-white/5
    p-8">


<h3 class="
    text-2xl
    font-bold">

Financial Management

</h3>



<p class="
    mt-3
    text-zinc-400">

Handle tuition, payments
and financial reports.

</p>



<div class="
    mt-6
    flex
    flex-wrap
    gap-3">


<span class="feature-pill">
Invoices
</span>


<span class="feature-pill">
Payment tracking
</span>


<span class="feature-pill">
Financial reports
</span>


</div>


</div>


</div>









<!-- Communication -->


<div class="
    roadmap-item
    relative
    md:flex
    gap-10">


<div class="
    hidden
    md:flex
    w-10
    h-10
    rounded-full
    bg-orange-500
    items-center
    justify-center
    z-10">

🔔

</div>




<div class="
    flex-1
    rounded-3xl
    border
    border-white/10
    bg-white/5
    p-8">


<h3 class="
    text-2xl
    font-bold">

Communication Hub

</h3>



<p class="
    mt-3
    text-zinc-400">

A centralized communication system
between schools and families.

</p>



<div class="
    mt-6
    flex
    flex-wrap
    gap-3">


<span class="feature-pill">
Announcements
</span>


<span class="feature-pill">
Email/SMS alerts
</span>


<span class="feature-pill">
Messaging
</span>


</div>


</div>


</div>








<!-- Exams -->


<div class="
    roadmap-item
    relative
    md:flex
    gap-10">


<div class="
    hidden
    md:flex
    w-10
    h-10
    rounded-full
    bg-pink-600
    items-center
    justify-center
    z-10">

💻

</div>



<div class="
    flex-1
    rounded-3xl
    border
    border-white/10
    bg-white/5
    p-8">


<h3 class="
    text-2xl
    font-bold">

Digital Exams

</h3>



<p class="
    mt-3
    text-zinc-400">

Create assignments and
online assessments.

</p>



<div class="
    mt-6
    flex
    flex-wrap
    gap-3">


<span class="feature-pill">
Quizzes
</span>


<span class="feature-pill">
Auto grading
</span>


<span class="feature-pill">
Teacher feedback
</span>


</div>


</div>


</div>



</div>

</div>


</section>

<section class="
    trust-section
    py-32">


<div class="
    max-w-7xl
    mx-auto
    px-6">


<div class="
    text-center
    max-w-3xl
    mx-auto
    mb-16">


<p class="
    text-indigo-400
    uppercase
    tracking-widest
    text-sm
    font-semibold">

    Why choose us

</p>


<h2 class="
    mt-4
    text-4xl
    md:text-6xl
    font-bold">

Built for modern
education


</h2>


<p class="
    mt-6
    text-zinc-400
    text-lg">

A secure and scalable platform
designed around the daily needs
of schools.

</p>


</div>







<!-- Cards -->


<div class="
    grid
    md:grid-cols-2
    lg:grid-cols-4
    gap-6">





<div class="
    trust-card
    rounded-3xl
    border
    border-white/10
    bg-white/5
    p-8">


<div class="
    text-4xl
    mb-6">

🔐

</div>


<h3 class="
    text-xl
    font-bold">

Secure by design

</h3>


<p class="
    mt-4
    text-zinc-400">

Role-based access,
protected data and
controlled permissions.

</p>


</div>






<div class="
    trust-card
    rounded-3xl
    border
    border-white/10
    bg-white/5
    p-8">


<div class="
    text-4xl
    mb-6">

⚡

</div>


<h3 class="
    text-xl
    font-bold">

Fast & reliable

</h3>


<p class="
    mt-4
    text-zinc-400">

Optimized workflows
for teachers and
administrators.

</p>


</div>







<div class="
    trust-card
    rounded-3xl
    border
    border-white/10
    bg-white/5
    p-8">


<div class="
    text-4xl
    mb-6">

📊

</div>


<h3 class="
    text-xl
    font-bold">

Data driven

</h3>


<p class="
    mt-4
    text-zinc-400">

Transform school data
into meaningful insights.

</p>


</div>







<div class="
    trust-card
    rounded-3xl
    border
    border-white/10
    bg-white/5
    p-8">


<div class="
    text-4xl
    mb-6">

🚀

</div>


<h3 class="
    text-xl
    font-bold">

Built to grow

</h3>


<p class="
    mt-4
    text-zinc-400">

Ready for additional
modules and future
expansion.

</p>


</div>



</div>


</section>

<section class="
    cta-section
    py-32
    relative
    overflow-hidden">


<!-- Background glow -->

<div class="
    cta-glow
    absolute
    top-1/2
    left-1/2
    -translate-x-1/2
    -translate-y-1/2
    w-[500px]
    h-[500px]
    rounded-full
    bg-indigo-600/30
    blur-[120px]">
</div>





<div class="
    cta-content
    relative
    max-w-5xl
    mx-auto
    px-6
    text-center">



<h2 class="
    text-5xl
    md:text-7xl
    font-bold
    leading-tight">


Transform the way
your school operates.


</h2>



<p class="
    mt-8
    max-w-2xl
    mx-auto
    text-lg
    text-zinc-400">


Manage students,
teachers and academic operations
with one powerful platform.


</p>





<div class="
    mt-10
    flex
    justify-center
    gap-5
    flex-wrap">



<a href="/admin"
class="
px-8
py-4
rounded-2xl
bg-indigo-600
hover:bg-indigo-500
transition
font-semibold
shadow-lg
shadow-indigo-600/30">


Open Dashboard


</a>




<a href="#features"
class="
px-8
py-4
rounded-2xl
border
border-white/10
hover:bg-white/5
transition">


Explore Platform


</a>



</div>


</div>



</section>


</body>

<footer class="
    border-t
    border-white/10
    py-10">


<div class="
    max-w-7xl
    mx-auto
    px-6
    flex
    flex-col
    md:flex-row
    justify-between
    gap-6
    text-zinc-400">



<div>


<h3 class="
    text-white
    font-bold
    text-xl">


SchoolOS


</h3>


<p class="
    mt-2
    text-sm">


Modern school management platform.


</p>


</div>





<div class="
    flex
    gap-8
    text-sm">


<a href="#features"
class="hover:text-white transition">

Features

</a>


<a href="/admin"
class="hover:text-white transition">

Dashboard

</a>


<a href="#"
class="hover:text-white transition">

Contact

</a>



</div>





<div class="text-sm">


© {{ date('Y') }}
SchoolOS.
All rights reserved.


</div>



</div>


</footer>

</html>