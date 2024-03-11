<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('logintitle')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <link rel="icon" type="image/png" href="loginasset/images/icons/favicon.ico" /> --}}

    <link rel="stylesheet" type="text/css" href="{{ url('loginasset/vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('loginasset/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('loginasset/vendor/animate/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('loginasset/vendor/css-hamburgers/hamburgers.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('loginasset/vendor/select2/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('loginasset/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('loginasset/css/main.css') }}">

    <meta name="robots" content="noindex, follow">
    <script nonce="449041d5-c863-4e7a-b3be-6b8ea79a215f">
        (function(w, d) {
            ! function(a, b, c, d) {
                a[c] = a[c] || {};
                a[c].executed = [];
                a.zaraz = {
                    deferred: [],
                    listeners: []
                };
                a.zaraz.q = [];
                a.zaraz._f = function(e) {
                    return function() {
                        var f = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({
                            m: e,
                            a: f
                        })
                    }
                };
                for (const g of ["track", "set", "debug"]) a.zaraz[g] = a.zaraz._f(g);
                a.zaraz.init = () => {
                    var h = b.getElementsByTagName(d)[0],
                        i = b.createElement(d),
                        j = b.getElementsByTagName("title")[0];
                    j && (a[c].t = b.getElementsByTagName("title")[0].text);
                    a[c].x = Math.random();
                    a[c].w = a.screen.width;
                    a[c].h = a.screen.height;
                    a[c].j = a.innerHeight;
                    a[c].e = a.innerWidth;
                    a[c].l = a.location.href;
                    a[c].r = b.referrer;
                    a[c].k = a.screen.colorDepth;
                    a[c].n = b.characterSet;
                    a[c].o = (new Date).getTimezoneOffset();
                    if (a.dataLayer)
                        for (const n of Object.entries(Object.entries(dataLayer).reduce(((o, p) => ({
                                ...o[1],
                                ...p[1]
                            })), {}))) zaraz.set(n[0], n[1], {
                            scope: "page"
                        });
                    a[c].q = [];
                    for (; a.zaraz.q.length;) {
                        const q = a.zaraz.q.shift();
                        a[c].q.push(q)
                    }
                    i.defer = !0;
                    for (const r of [localStorage, sessionStorage]) Object.keys(r || {}).filter((t => t.startsWith(
                        "_zaraz_"))).forEach((s => {
                        try {
                            a[c]["z_" + s.slice(7)] = JSON.parse(r.getItem(s))
                        } catch {
                            a[c]["z_" + s.slice(7)] = r.getItem(s)
                        }
                    }));
                    i.referrerPolicy = "origin";
                    i.src = "../../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(a[c])));
                    h.parentNode.insertBefore(i, h)
                };
                ["complete", "interactive"].includes(b.readyState) ? zaraz.init() : a.addEventListener(
                    "DOMContentLoaded",
                    zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);


        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const showPasswordIcon = document.querySelector(".show-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordIcon.classList.add("show");
            } else {
                passwordInput.type = "password";
                showPasswordIcon.classList.remove("show");
            }
        }
    </script>
    @if (session('failed'))
        <div id="popup-message" class="popup-message">
            {{ session('failed') }}
        </div>
    @endif

    @if ($errors->any())
        <div id="error-popup" class="error-popup">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        /* message */
        .popup-message {
            position: fixed;
            top: 20px;
            right: -400px;
            /* Initially off screen */
            width: 300px;
            padding: 15px;
            background-color: #ee1919;
            color: #fff;
            border-radius: 10px;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(50%);
            transition: right 0.5s ease-in-out;
            z-index: 9999;
        }

        .popup-message.active {
            right: 20px;
            /* Slide in from the right */
        }

        /* error */
        .error-popup {
            position: fixed;
            top: 20px;
            right: -400px;
            /* Initially off screen */
            width: 300px;
            padding: 15px;
            background-color: #ee1919;
            color: #fff;
            border-radius: 10px;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(50%);
            transition: right 0.5s ease-in-out;
            z-index: 9999;
        }

        .error-popup.active {
            right: 20px;
            /* Slide in from the right */
        }
    </style>
</head>

<body>
    @section('contentlogin')
    @show
    <script src="{{ url('loginasset/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ url('loginasset/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ url('loginasset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ url('loginasset/vendor/select2/select2.min.js') }}"></script>

    <script src="{{ url('loginasset/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })


        //    message
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.getElementById('popup-message');

            if (popup) {
                popup.classList.add('active');
                setTimeout(function() {
                    popup.classList.remove('active');
                }, 3000); // Adjust the duration (milliseconds) as needed
            }
        });

        // error
        document.addEventListener('DOMContentLoaded', function() {
            const errorPopup = document.getElementById('error-popup');

            if (errorPopup) {
                errorPopup.classList.add('active');
                setTimeout(function() {
                    errorPopup.classList.remove('active');
                }, 5000); // Adjust the duration (milliseconds) as needed
            }
        });
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>


    <script src="js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2cb3a2ab87c5498db5ce7e6608cf55231689030342039"
        integrity="sha512-DI3rPuZDcpH/mSGyN22erN5QFnhl760f50/te7FTIYxodEF8jJnSFnfnmG/c+osmIQemvUrnBtxnMpNdzvx1/g=="
        data-cf-beacon='{"rayId":"7ea8d916ac4f93a1","version":"2023.4.0","b":1,"token":"cd0b4b3a733644fc843ef0b185f98241","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>
