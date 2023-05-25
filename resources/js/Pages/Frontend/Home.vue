<template>
    <div class="outer_wrapper ">
        <!-- nav_ber start -->
        <nav class="nav_ber_container container">
            <div class="logo_ber_content">
                <a class="block py-1" href="#">
                    <img src="/logo.jpg" alt="" class="h-[15px] w-auto object-contain block">
                </a>
            </div>
            <div class="menu_ber_content">
                <a href="#">Home</a>
                <a href="#">Features</a>
                <div class="dropdown_container">
                    <a href="#">Usage</a>
                    <div class="dropdown_content">
                        <a href="#">Team Building</a>
                        <a href="#">Scevengar Hunt</a>
                        <a href="#">Event Gamification</a>
                        <a href="#">Tourism</a>
                        <a href="#">Tourism</a>
                    </div>
                </div>
                <a href="/login">Login</a>
                <!-- <a href="/register">Register</a> -->
            </div>
        </nav>
    </div>
    <div class="flex shadow !flex-row text-black lg:!hidden">
        <div>
            <a class="block py-1" href="#">
                <img src="/logo.jpg" alt="" class="h-[50px] w-auto object-contain block">
            </a>
        </div>
        <div class="flex !flex-row !justify-end text-black gap-3 flex-1">
            <a href="/login" class="block !text-black">Login</a>
            <!-- <a href="/register" class="block !text-black">Register</a> -->
        </div>
    </div>
    <div class="project_outer">
        <!-- nav_ber end -->
        <!-- banner start -->
        <div class="banner_wraper container">
            <div class="banner_text ">
                <h1 class="title">
                    Scavenger Hunts,<br>
                    <span> Made Possible</span>
                </h1>
                <p class="banner_description">
                    PlayTours makes it easy for anyone to build and run scavenger hunts of any size, anywhere. We're great for Event Gamification & Self-Guided Tours too! We will guide you from start to end.
                </p>
                <div class="banner_btn">
                    <a href="/login" class="btn1 flex items-center justify-center">Start Now</a>
                    <a href="/register" class="btn2 flex items-center justify-center text-center">Register</a>
                </div>
            </div>
            <img class="banner_img" src="/assets/img/banner-img.png" alt="">
        </div>
    </div>
    <!-- banner end -->

    <!-- card_wraper start -->
    <div class="card_wraper container">
        <h2 class="card_title"><span> Make </span> Anything <span> Fun </span></h2>
        <div class="make_card_wraper">
            <div class="card_manage">
                <div class="card1">
                    <div class="circle">
                        <h1>1</h1>
                    </div>
                    <h3 class="card1_title">Scavenger Hunts</h3>
                    <p class="card1_para">
                        Guide players from point to point and complete tasks. Points can also be set to be free-flow.
                    </p>
                </div>
                <div class="card1">
                    <div class="circle">
                        <h1>2</h1>
                    </div>
                    <h3 class="card1_title">Event Gamification</h3>
                    <p class="card1_para">
                        Engage event-goers to encourage them to visit booths and participate in activities.
                    </p>
                </div>
                <div class="card1">
                    <div class="circle">
                        <h1>3</h1>
                    </div>
                    <h3 class="card1_title">Virtual Events</h3>
                    <p class="card1_para">
                        Create amazing virtual experiences such as escape rooms and city tours.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- card_wraper end -->


    <!-- play tours start -->
    <div class="tours_wraper container_small">
        <h2 class="tours_title"> <span class="black"> Why </span> PlayTours <span> ? </span> </h2>
        <p class="tours_para container">
            PlayTours robust features and game design flexibility allow anyone to implement their next big idea within minutes. Our unlimited free trial gives you as much time as you need.
        </p>
        <div class="tours_container container">
            <div class="tours_content">
                <img src="/assets/img/tours_1.png" alt="">
                <h3 class="tours_content_title">Robust Features</h3>
                <p class="tours_content_para">
                    PlayTours has features to build any game logic you can think of. Our years of experience in gamification resulted in every feature imaginable.
                </p>
            </div>
            <div class="tours_content">
                <img src="/assets/img/tours_2.png" alt="">
                <h3 class="tours_content_title">Easy to Use</h3>
                <p class="tours_content_para">
                    Building games on PlayTours is effortless - no coding or comples drag-and-drop logic is required.Otherwise, our solutions team can give you tailored advice within 24 hours.
                </p>
            </div>
            <div class="tours_content">
                <img src="/assets/img/tours_3.webp" alt="">
                <h3 class="tours_content_title">Scalable</h3>
                <p class="tours_content_para">
                    Automate your clues and other mechanisms that typically require human facilitators.With PlayTours, it is possible to run a 1000 pax game with only 4 people.
                </p>
            </div>
        </div>
    </div>
    <!-- play tours end -->


    <!-- Features start -->
    <h2 class="feature_title">Features <span> For Any </span> Event</h2>
    <div class="feature_wraper  container">

        <div class="event_icon ">
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Easy-to-use Game Builder</span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Flexible Formatting </span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Photo and Video Uploads </span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> QR code scanning</span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Hints can be Bought or Shown after X Minutes </span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Reward Players for Completing Tasks Quickly</span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Chat Within or Between Teams </span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Restrict Task Completions to First X Teams </span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Reward Players with Digital Items</span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Customize Task Completion Screen</span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Customisable Background Image and Logo</span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Live Leaderboard </span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Manually Approve/Reject Answers </span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Give Game-wide or Chapter-wide Time Limits</span>
            <span> <i class="fa fa-smile-o" aria-hidden="true"></i> Add Background Music</span>
        </div>
    </div>
    <!-- Features end -->


    <!-- amazing_3 end -->
    <div class="bottom_amazing">
        <div class="amazing_wraper container">
            <div class="amazing_video_img">
                <div class="amazing_video_content">
                    <img src="/assets/img/amazing.png" alt="">
                </div>
            </div>
            <div class="amazing_1 center">
                <div class="amazing_text">
                    <h3 class="phone_amazing"><span> 👁 </span> See where teams are </h3>
                    <p class="amazing_para">
                        Organizers can access a dashboard that contains a map to see where teams physically are.
                    </p>
                </div>
                <div class="amazing_text">
                    <h3 class="phone_amazing"><span> 🖥️ </span> Centralised dashboard </h3>
                    <p class="amazing_para">
                        Access important information, updated in real-time, such as leaderboard position, teams' game progress and many more.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- amazing 4 end -->

    <div class="amazing_end_wrapper container">
        <div class="amazing_card">
            <h4 class="amazing_card_icon"><i class="fa fa-eye" aria-hidden="true"></i></h4>
            <p class="amazing_card_para">
                "I appreciate how simple the instructions were laid out and how simple it was for our participants. So many features and it felt like it was our own scavenger hunt and not just another generic app!"
            </p>
        </div>
        <div class="amazing_card">
            <h4 class="amazing_card_icon"><i class="fa fa-bullhorn" aria-hidden="true"></i></h4>
            <p class="amazing_card_para">
                "We had an enormously good experience, and we as moderators had a very manageable task as your system was so easily accessible. We thank you many times for that."
            </p>
        </div>
        <div class="amazing_card">
            <h4 class="amazing_card_icon"><i class="fa fa-female" aria-hidden="true"></i></h4>
            <p class="amazing_card_para">
                “Thank you for all your help and support so far with our events and usage of Playtours! It has been nothing less than absolutely perfect.”
            </p>
        </div>
    </div>
    <!-- amazing end -->

    <!-- question end -->
    <!-- footer start -->
    <div class="footer_wraper">
        <div class="flex container">
            <div class="footer_text">
                <h6>©2022 PLAYTOURS PTE. LTD</h6>
                <h6>ALL RIGHTS RESERVED. WE ARE A GLOBAL COMPANY, PROUDLY CREATED IN SINGAPORE.</h6>
            </div>
            <div class="footer_icon">
                <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="fa fa-twitter-square" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                </a>
            </div>
            <div class="msg">
                <a href="#">
                    <i class="fa fa-inbox" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import '../../../css/frontend/main.css'

</script>