<footer class="footer ">
    <div class="container">
        <div class="footer__wrapper">
            <div class="footer__bottom">
                <div class="footer__end">
                    <div class="footer__end-copyright">
                        <p class=" mb-0"> © {{ now()->year }} All Rights Reserved By
                            <a href="{{ route('front.login') }}">
                                Safe Captial
                            </a>
                        </p>
                    </div>
                    <div>
                        <ul class="social">
                            <li class="social__item"> <a href="{{ route('front.about') }}"> About Us</a> </li>
                            <li class="social__item"> <a href="{{ route('front.contact') }}"> Contact Us</a> </li>
                            <li class="social__item"> <a href="{{ route('front.privacy.policy') }}"> privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__shape">
        <span class="footer__shape-item footer__shape-item--3"><img src="{{ asset('front/images/footer/1.png') }}"
                alt="shape icon"></span>
    </div>
</footer>
