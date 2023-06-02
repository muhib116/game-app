<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title inertia>{{ config('app.name') }}</title>
        <link rel="shortcut icon" href="{{ asset('logo.jpg') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        
        

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script type="text/javascript">
            window.onload = function() {
                document.querySelector('.trans_btn').style.display = 'block';
            }
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }

            function toogleTranslator(){
                console.log(document.querySelector('.trans_wrap'));
                // translatorWrapper.classList.toggle('-right-[0px]')
                let wrap = document.querySelector('.trans_wrap');
                if (wrap) {
                    wrap.classList.toggle('active')
                    if (wrap.style.display == 'none') {
                        wrap.style.display = 'block'
                    } else {
                        wrap.style.display = 'none'
                    }
                }
                initListener()
                
            }
            if (localStorage.getItem('lng')) {
                if (localStorage.getItem('lng') == 'en') {
                    document.querySelector('.l1').checked = true
                    document.querySelector('.l2').checked = false
                } else {
                    document.querySelector('.l1').checked = false
                    document.querySelector('.l2').checked = true
                }
            }
            document.querySelectorAll('.lan_inp').forEach(item => {
                item.addEventListener('change', function() {
                    if(this.value == 'Norwegian') {
                        localStorage.setItem('lng', 'no')
                        document.querySelector('.goog-te-combo').value = 'no';
                        document.querySelector('.goog-te-combo').dispatchEvent(new Event('change'));
                        // new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                    } else {
                        localStorage.setItem('lng', 'en')
                        document.querySelector('.goog-te-combo').value = 'en';
                        document.querySelector('.goog-te-combo').dispatchEvent(new Event('change'));
                        // new google.translate.TranslateElement({pageLanguage: 'no'}, 'google_translate_element');
                    }
                })
            })

            function initListener() {
                if (document.querySelector('#translatorWrapper select')) {
                    document.querySelector('#translatorWrapper select').addEventListener('change', ()=> {
                        toogleTranslator()
                    })
                }
            }
        </script>
        <style>
            
            /* .skiptranslate {
                display: none !important;
            }
            #google_translate_element .skiptranslate {
                display: block !important;
            }
            .trans_wrap {
                display: none;
            }
            .trans_wrap.active {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.7);
                backdrop-filter: blur(5px);
                z-index: 999;
                display: block;
            }
            #translatorWrapper {
                position: fixed;
                z-index: 999;
                top: 50%;
                left: 50%;
            }
            .trans_btn {
                display: block !important;
            }
            #goog-gt- {
                display: none !important;
            }
            html body {
                top: 0 !important;
            } */
        </style>
    </body>
</html>
