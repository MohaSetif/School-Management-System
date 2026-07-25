import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);


document.addEventListener("DOMContentLoaded", () => {


    /*
    |--------------------------------------------------------------------------
    | Hero Section
    |--------------------------------------------------------------------------
    */


    gsap.from(".hero-badge", {

        y: -30,
        opacity: 0,
        duration: .8,
        ease: "power3.out"

    });



    gsap.from(".hero-title span", {

        y: 80,
        opacity: 0,
        stagger: 0.08,
        duration: 1,
        ease: "power4.out"

    });



    gsap.from(".hero-description", {

        y: 40,
        opacity: 0,
        duration: 1,
        delay: .4,
        ease: "power3.out"

    });



    gsap.from(".hero-actions", {

        y: 30,
        opacity: 0,
        duration: .8,
        delay: .6,
        ease: "power3.out"

    });





    /*
    |--------------------------------------------------------------------------
    | Dashboard Preview
    |--------------------------------------------------------------------------
    */


    gsap.from(".dashboard-preview", {

        y: 120,
        opacity: 0,
        scale: .92,
        duration: 1.3,
        delay: 1,
        ease: "power4.out"

    });



    gsap.to(".dashboard-preview", {

        y: -20,
        repeat: -1,
        yoyo: true,
        duration: 4,
        ease: "sine.inOut"

    });





    /*
    |--------------------------------------------------------------------------
    | Feature Cards
    |--------------------------------------------------------------------------
    */

    const moduleCards = document.querySelectorAll(".module-card");

    if (moduleCards.length) {

        gsap.set(moduleCards, {
            opacity: 0,
            y: 60
        });


        ScrollTrigger.create({

            trigger: "#features",
            start: "top 30%",

            onEnter: () => {

                gsap.to(moduleCards, {

                    opacity: 1,
                    y: 0,

                    stagger: 0.15,

                    duration: 0.8,

                    ease: "power3.out"

                });

            }

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Section
    |--------------------------------------------------------------------------
    */


    gsap.from(".dashboard-section-content", {

        scrollTrigger: {

            trigger: ".dashboard-section",
            start: "top 35%",

        },

        y: 80,
        opacity: 0,
        duration: 1,
        ease: "power3.out"

    });







    /*
    |--------------------------------------------------------------------------
    | Roadmap Timeline
    |--------------------------------------------------------------------------
    */


    gsap.from(".roadmap-item", {

        scrollTrigger: {

            trigger: ".roadmap-section",
            start: "top 5%",

        },

        opacity: 0,
        y: 80,
        stagger: .15,
        duration: .8,
        ease: "power3.out"

    });







    /*
    |--------------------------------------------------------------------------
    | Trust Section
    |--------------------------------------------------------------------------
    */


    gsap.from(".trust-card", {

        scrollTrigger: {

            trigger: ".trust-section",
            start: "top 25%",

        },

        y: 70,
        opacity: 0,
        stagger: .15,
        duration: .8,
        ease: "power3.out"

    });





    /*
    |--------------------------------------------------------------------------
    | Statistics Counters
    |--------------------------------------------------------------------------
    */


    document.querySelectorAll(".counter, .trust-number")
    .forEach(counter => {


        let target = Number(counter.dataset.value);



        gsap.from(counter, {

            textContent: 0,

            duration: 2,

            snap: {
                textContent: 1
            },


            scrollTrigger: {

                trigger: counter,
                start: "top 85%"

            },


            ease: "power1.out"

        });


    });








    /*
    |--------------------------------------------------------------------------
    | CTA Section
    |--------------------------------------------------------------------------
    */


    gsap.from(".cta-content", {

        scrollTrigger: {

            trigger: ".cta-section",
            start: "top 80%"

        },

        y: 80,
        opacity: 0,
        duration: 1,
        ease: "power3.out"

    });




    gsap.to(".cta-glow", {

        scale: 1.2,
        opacity: .8,
        repeat: -1,
        yoyo: true,
        duration: 3,
        ease: "sine.inOut"

    });







    /*
    |--------------------------------------------------------------------------
    | Refresh ScrollTrigger
    |--------------------------------------------------------------------------
    */


    setTimeout(() => {
        ScrollTrigger.refresh();
    }, 500);

});