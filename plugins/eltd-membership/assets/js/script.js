// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
if (typeof eltdSocialLoginVars !== 'undefined') {
    var facebookAppId = eltdSocialLoginVars.social.facebookAppId;
}
if (facebookAppId) {
    window.fbAsyncInit = function () {
        FB.init({
            appId: facebookAppId, //265124653818954 - test app ID
            cookie: true,  // enable cookies to allow the server to access
            xfbml: true,  // parse social plugins on this page
            version: 'v2.5' // use version 2.5
        });

        window.FB = FB;
    };
}

(function ($) {
    "use strict";

    var socialLogin = {};
    if (typeof eltd !== 'undefined') {
        eltd.modules.socialLogin = socialLogin;
    }

    socialLogin.eltdUserLogin = eltdUserLogin;
    socialLogin.eltdUserRegister = eltdUserRegister;
    socialLogin.eltdUserLostPassword = eltdUserLostPassword;
    socialLogin.eltdInitLoginWidgetModal = eltdInitLoginWidgetModal;
    socialLogin.eltdInitFacebookLogin = eltdInitFacebookLogin;
    socialLogin.eltdInitGooglePlusLogin = eltdInitGooglePlusLogin;
    socialLogin.eltdUpdateUserProfile = eltdUpdateUserProfile;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function eltdOnDocumentReady() {
        eltdInitLoginWidgetModal();
        eltdUserLogin();
        eltdUserRegister();
        eltdUserLostPassword();
        eltdUpdateUserProfile();
    }

    /**
     * All functions to be called on $(window).on('load', ) should be in this function
     */
    function eltdOnWindowLoad() {
        eltdInitFacebookLogin();
        eltdInitGooglePlusLogin();
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function eltdOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function eltdOnWindowScroll() {
    }

    /**
     * Initialize login widget modal
     */
    function eltdInitLoginWidgetModal() {

        var modalOpener = $('.eltd-login-opener'),
            modalHolder = $('.eltd-login-register-holder')

        if (modalOpener) {
            var tabsHolder = $('.eltd-login-register-content');

            //Init opening login modal
            modalOpener.click(function (e) {
                e.preventDefault();
                modalHolder.fadeIn(300);
                modalHolder.addClass('opened');
            });

            //Init closing login modal
            modalHolder.click(function (e) {
                if (modalHolder.hasClass('opened')) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });
            $('.eltd-login-register-content').click(function (e) {
                e.stopPropagation();
            });
            // on esc too
            $(window).on('keyup', function (e) {
                if (modalHolder.hasClass('opened') && e.keyCode == 27) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });

            //Init tabs
            tabsHolder.tabs();
        }


    }

    /**
     * Login user via Ajax
     */
    function eltdUserLogin() {
        $('.eltd-login-form').on('submit', function (e) {
            e.preventDefault();
            var ajaxData = {
                action: 'eltd_membership_login_user',
                security: $(this).find('#eltd-login-security').val(),
                login_data: $(this).serialize()
            };
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedMembershipAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }

            });
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function eltdUserRegister() {

        $('.eltd-register-form').on('submit', function (e) {
            e.preventDefault();

            var modalLogin = $('#eltd-login-content');
            var modalRegister = $('#eltd-register-content');

            var ajaxData = {
                action: 'eltd_membership_register_user',
                security: $(this).find('#eltd-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedMembershipAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        modalRegister.css("display", "none");
                        modalLogin.css("display", "block");
                        //window.location = response.redirect;
                        
                    }
                }
            });

            return false;

        });

    }

    /**
     * Reset user password
     */
    function eltdUserLostPassword() {

        var lostPassForm = $('.eltd-reset-pass-form');
        lostPassForm.submit(function (e) {
            e.preventDefault();
            var data = {
                action: 'eltd_membership_user_lost_password',
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: ElatedMembershipAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    eltdRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });

    }

    /**
     * Response notice for users
     * @param response
     */
    function eltdRenderAjaxResponseMessage(response) {

        var responseHolder = $('.eltd-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.eltd-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'eltd-membership-message-succes';
        } else {
            messageClass = 'eltd-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);

    }

    /**
     * Facebook Login
     */
    function eltdInitFacebookLogin() {

        var loginForm = $('.eltd-facebook-login-holder');
        loginForm.submit(function (e) {
            e.preventDefault();
            window.FB.login(function (response) {
                eltdFacebookCheckStatus(response);
            }, { scope: 'email, public_profile' });
        });

    }

    /**
     * Check if user is logged into Facebook and App
     *
     * @param response
     */
    function eltdFacebookCheckStatus(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            eltdGetFacebookUserData();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Please log into this app');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('Please log into Facebook');
        }
    }

    /**
     * Get user data from Facebook and login user
     */
    function eltdGetFacebookUserData() {
        console.log('Welcome! Fetching information from Facebook...');
        FB.api('/me', 'GET', { 'fields': 'id, name, email, link, picture' }, function (response) {
            var nonce = $('.eltd-facebook-login-holder [name^=eltd_nonce_facebook_login]').val();
            response.nonce = nonce;
            response.image = response.picture.data.url;
            var data = {
                action: 'eltd_membership_check_facebook_user',
                response: response
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: ElatedMembershipAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

        });
    }

    /**
     * Google Login
     */
    function eltdInitGooglePlusLogin() {

        if (typeof eltdSocialLoginVars !== 'undefined') {
            var clientId = eltdSocialLoginVars.social.googleClientId; //264816150753-nuqvhjpa2845drc4lt71r53l6qog3o7b.apps.googleusercontent.com  - test clientID
        }
        if (clientId) {
            gapi.load('auth2', function () {
                window.auth2 = gapi.auth2.init({
                    client_id: clientId
                });
                eltdInitGooglePlusLoginButton();
            });
        } else {
            var loginForm = $('.eltd-google-login-holder');
            loginForm.submit(function (e) {
                e.preventDefault();
            });
        }

    }

    /**
     * Initialize login button for Google Login
     */
    function eltdInitGooglePlusLoginButton() {

        var loginForm = $('.eltd-google-login-holder');
        loginForm.submit(function (e) {
            e.preventDefault();
            window.auth2.signIn();
            eltdSignInCallback();
        });

    }

    /**
     * Get user data from Google and login user
     */
    function eltdSignInCallback() {
        var signedIn = window.auth2.isSignedIn.get();
        if (signedIn) {
            var currentUser = window.auth2.currentUser.get(),
                profile = currentUser.getBasicProfile(),
                nonce = $('.eltd-google-login-holder [name^=eltd_nonce_google_login]').val(),
                userData = {
                    id: profile.getId(),
                    name: profile.getName(),
                    email: profile.getEmail(),
                    image: profile.getImageUrl(),
                    link: 'https://plus.google.com/' + profile.getId(),
                    nonce: nonce
                },
                data = {
                    action: 'eltd_membership_check_google_user',
                    response: userData
                };
            $.ajax({
                type: 'POST',
                data: data,
                url: ElatedMembershipAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        }
    }

    /**
     * Update User Profile
     */
    function eltdUpdateUserProfile() {
        var updateForm = $('#eltd-membership-update-profile-form');
        if (updateForm.length) {
            var btnText = updateForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            updateForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'eltd_membership_update_user_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: ElatedMembershipAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        eltdRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                            window.location = response.redirect;
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

})(jQuery);