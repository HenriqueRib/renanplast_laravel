<div style="width: 100vw;
text-align: center;
background: white;
position: fixed;
bottom: 1;">
    <div class="js-cookie-consent cookie-consent">
        <div class="container" style="font-size: 20px;">
            <span class="cookie-consent__message">
                {!! trans('cookieConsent::texts.message') !!}
            </span>
            <div>
                <button class="btn btn-success js-cookie-consent-agree cookie-consent__agree">
                    {{ trans('cookieConsent::texts.agree') }}
                </button>
            </div>
        </div>
    </div>
</div>
