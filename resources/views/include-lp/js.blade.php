
<script id='wp-postviews-cache-js-extra'>
    var viewsCacheL10n = {
        "admin_ajax_url": "https:\/\/digital-deck.com\/wp-admin\/admin-ajax.php",
        "post_id": "263"
    };
</script>
<script src='https://digital-deck.com/wp-content/plugins/wp-postviews/postviews-cache.js?ver=1.68'
    id='wp-postviews-cache-js' defer></script>
<script id='ppress-frontend-script-js-extra'>
    var pp_ajax_form = {
        "ajaxurl": "https:\/\/digital-deck.com\/wp-admin\/admin-ajax.php",
        "confirm_delete": "Are you sure?",
        "deleting_text": "Deleting...",
        "deleting_error": "An error occurred. Please try again.",
        "nonce": "19e060ba34",
        "disable_ajax_form": "false",
        "is_checkout": "0",
        "is_checkout_tax_enabled": "0"
    };
</script>
<script src='https://digital-deck.com/wp-content/plugins/wp-user-avatar/assets/js/frontend.min.js?ver=4.3.1'
    id='ppress-frontend-script-js' defer></script>
<script
    src='https://digital-deck.com/wp-content/plugins/duracelltomi-google-tag-manager/js/gtm4wp-form-move-tracker.js?ver=1.16.1'
    id='gtm4wp-form-move-tracker-js' defer></script>
<script id='rocket-browser-checker-js-after'>
    class RocketBrowserCompatibilityChecker {

        constructor(options) {
            this.passiveSupported = false;

            this._checkPassiveOption(this);
            this.options = this.passiveSupported ? options : false;
        }

        /**
         * Initializes browser check for addEventListener passive option.
         *
         * @link https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener#Safely_detecting_option_support
         * @private
         *
         * @param self Instance of this object.
         * @returns {boolean}
         */
        _checkPassiveOption(self) {
            try {
                const options = {
                    // This function will be called when the browser attempts to access the passive property.
                    get passive() {
                        self.passiveSupported = true;
                        return false;
                    }
                };

                window.addEventListener('test', null, options);
                window.removeEventListener('test', null, options);
            } catch (err) {
                self.passiveSupported = false;
            }
        }

        /**
         * Checks if the browser supports requestIdleCallback and cancelIdleCallback. If no, shims its behavior with a polyfills.
         *
         * @link @link https://developers.google.com/web/updates/2015/08/using-requestidlecallback
         */
        initRequestIdleCallback() {
            if (!'requestIdleCallback' in window) {
                window.requestIdleCallback = (cb) => {
                    const start = Date.now();
                    return setTimeout(() => {
                        cb({
                            didTimeout: false,
                            timeRemaining: function timeRemaining() {
                                return Math.max(0, 50 - (Date.now() - start));
                            }
                        });
                    }, 1);
                };
            }

            if (!'cancelIdleCallback' in window) {
                window.cancelIdleCallback = (id) => clearTimeout(id);
            }
        }

        /**
         * Detects if data saver mode is on.
         *
         * @link https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/save-data/#detecting_the_save-data_setting
         *
         * @returns {boolean|boolean}
         */
        isDataSaverModeOn() {
            return (
                'connection' in navigator &&
                true === navigator.connection.saveData
            );
        }

        /**
         * Checks if the browser supports link prefetch.
         *
         * @returns {boolean|boolean}
         */
        supportsLinkPrefetch() {
            const elem = document.createElement('link');
            return (
                elem.relList &&
                elem.relList.supports &&
                elem.relList.supports('prefetch') &&
                window.IntersectionObserver &&
                'isIntersecting' in IntersectionObserverEntry.prototype
            );
        }

        isSlowConnection() {
            return (
                'connection' in navigator &&
                'effectiveType' in navigator.connection &&
                (
                    '2g' === navigator.connection.effectiveType ||
                    'slow-2g' === navigator.connection.effectiveType
                )
            )
        }
    }
</script>
<script id='rocket-preload-links-js-extra'>
    var RocketPreloadLinksConfig = {
        "excludeUris": "\/(?:.+\/)?feed(?:\/(?:.+\/?)?)?$|\/(?:.+\/)?embed\/|\/(index\\.php\/)?wp\\-json(\/.*|$)|\/refer\/|\/go\/|\/recommend\/|\/recommends\/",
        "usesTrailingSlash": "1",
        "imageExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php",
        "fileExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php|html|htm",
        "siteUrl": "https:\/\/digital-deck.com",
        "onHoverDelay": "100",
        "rateThrottle": "3"
    };
</script>
<script id='rocket-preload-links-js-after'>
    class RocketPreloadLinks {

        constructor(browser, config) {
            this.browser = browser;
            this.config = config;
            this.options = this.browser.options;

            this.prefetched = new Set;
            this.eventTime = null;
            this.threshold = 1111;
            this.numOnHover = 0;
        }

        /**
         * Initializes the handler.
         */
        init() {
            if (
                !this.browser.supportsLinkPrefetch() ||
                this.browser.isDataSaverModeOn() ||
                this.browser.isSlowConnection()
            ) {
                return;
            }

            this.regex = {
                excludeUris: RegExp(this.config.excludeUris, 'i'),
                images: RegExp('.(' + this.config.imageExt + ')$', 'i'),
                fileExt: RegExp('.(' + this.config.fileExt + ')$', 'i')
            };

            this._initListeners(this);
        }

        /**
         * Initializes the event listeners.
         *
         * @private
         *
         * @param self instance of this object, used for binding "this" to the listeners.
         */
        _initListeners(self) {
            // Setting onHoverDelay to -1 disables the "on-hover" feature.
            if (this.config.onHoverDelay > -1) {
                document.addEventListener('mouseover', self.listener.bind(self), self.listenerOptions);
            }

            document.addEventListener('mousedown', self.listener.bind(self), self.listenerOptions);
            document.addEventListener('touchstart', self.listener.bind(self), self.listenerOptions);
        }

        /**
         * Event listener. Processes when near or on a valid <a> hyperlink.
         *
         * @param Event event Event instance.
         */
        listener(event) {
            const linkElem = event.target.closest('a');
            const url = this._prepareUrl(linkElem);
            if (null === url) {
                return;
            }

            switch (event.type) {
                case 'mousedown':
                case 'touchstart':
                    this._addPrefetchLink(url);
                    break;
                case 'mouseover':
                    this._earlyPrefetch(linkElem, url, 'mouseout');
            }
        }

        /**
         *
         * @private
         *
         * @param Element|null linkElem
         * @param object url
         * @param string resetEvent
         */
        _earlyPrefetch(linkElem, url, resetEvent) {
            const doPrefetch = () => {
                falseTrigger = null;

                // Start the rate throttle: 1 sec timeout.
                if (0 === this.numOnHover) {
                    setTimeout(() => this.numOnHover = 0, 1000);
                }
                // Bail out when exceeding the rate throttle.
                else if (this.numOnHover > this.config.rateThrottle) {
                    return;
                }

                this.numOnHover++;
                this._addPrefetchLink(url);
            };

            // Delay to avoid false triggers for hover/touch/tap.
            let falseTrigger = setTimeout(doPrefetch, this.config.onHoverDelay);

            // On reset event, reset the false trigger timer.
            const reset = () => {
                linkElem.removeEventListener(resetEvent, reset, {
                    passive: true
                });
                if (null === falseTrigger) {
                    return;
                }

                clearTimeout(falseTrigger);
                falseTrigger = null;
            };
            linkElem.addEventListener(resetEvent, reset, {
                passive: true
            });
        }

        /**
         * Adds a <link rel="prefetch" href="<url>"> for the given URL.
         *
         * @param string url The Given URL to prefetch.
         */
        _addPrefetchLink(url) {
            this.prefetched.add(url.href);

            return new Promise((resolve, reject) => {
                const elem = document.createElement('link');
                elem.rel = 'prefetch';
                elem.href = url.href;
                elem.onload = resolve;
                elem.onerror = reject;

                document.head.appendChild(elem);
            }).catch(() => {
                // ignore and continue.
            });
        }

        /**
         * Prepares the target link's URL.
         *
         * @private
         *
         * @param Element|null linkElem Instance of the link element.
         * @returns {null|*}
         */
        _prepareUrl(linkElem) {
            if (
                null === linkElem ||
                typeof linkElem !== 'object' ||
                !'href' in linkElem ||
                // Link prefetching only works on http/https protocol.
                ['http:', 'https:'].indexOf(linkElem.protocol) === -1
            ) {
                return null;
            }

            const origin = linkElem.href.substring(0, this.config.siteUrl.length);
            const pathname = this._getPathname(linkElem.href, origin);
            const url = {
                original: linkElem.href,
                protocol: linkElem.protocol,
                origin: origin,
                pathname: pathname,
                href: origin + pathname
            };

            return this._isLinkOk(url) ? url : null;
        }

        /**
         * Gets the URL's pathname. Note: ensures the pathname matches the permalink structure.
         *
         * @private
         *
         * @param object url Instance of the URL.
         * @param string origin The target link href's origin.
         * @returns {string}
         */
        _getPathname(url, origin) {
            let pathname = origin ?
                url.substring(this.config.siteUrl.length) :
                url;

            if (!pathname.startsWith('/')) {
                pathname = '/' + pathname;
            }

            if (this._shouldAddTrailingSlash(pathname)) {
                return pathname + '/';
            }

            return pathname;
        }

        _shouldAddTrailingSlash(pathname) {
            return (
                this.config.usesTrailingSlash &&
                !pathname.endsWith('/') &&
                !this.regex.fileExt.test(pathname)
            );
        }

        /**
         * Checks if the given link element is okay to process.
         *
         * @private
         *
         * @param object url URL parts object.
         *
         * @returns {boolean}
         */
        _isLinkOk(url) {
            if (null === url || typeof url !== 'object') {
                return false;
            }

            return (
                !this.prefetched.has(url.href) &&
                url.origin === this.config.siteUrl // is an internal document.
                &&
                url.href.indexOf('?') === -1 // not a query string.
                &&
                url.href.indexOf('#') === -1 // not an anchor.
                &&
                !this.regex.excludeUris.test(url.href) // not excluded.
                &&
                !this.regex.images.test(url.href) // not an image.
            );
        }

        /**
         * Named static constructor to encapsulate how to create the object.
         */
        static run() {
            // Bail out if the configuration not passed from the server.
            if (typeof RocketPreloadLinksConfig === 'undefined') {
                return;
            }

            const browser = new RocketBrowserCompatibilityChecker({
                capture: true,
                passive: true
            });
            const instance = new RocketPreloadLinks(browser, RocketPreloadLinksConfig);
            instance.init();
        }
    }

    RocketPreloadLinks.run();
</script>
<script
    src='https://digital-deck.com/wp-content/plugins/elementor-pro/assets/lib/smartmenus/jquery.smartmenus.js?ver=1.0.1'
    id='smartmenus-js' defer></script>
<script id='search-filter-plugin-build-js-extra'>
    var SF_LDATA = {
        "ajax_url": "https:\/\/digital-deck.com\/wp-admin\/admin-ajax.php",
        "home_url": "https:\/\/digital-deck.com\/",
        "extensions": ["search-filter-elementor"]
    };
</script>
<script
    src='https://digital-deck.com/wp-content/plugins/search-filter-pro/public/assets/js/search-filter-build.min.js?ver=2.5.8'
    id='search-filter-plugin-build-js' defer></script>
<script
    src='https://digital-deck.com/wp-content/plugins/search-filter-pro/public/assets/js/chosen.jquery.min.js?ver=2.5.8'
    id='search-filter-plugin-chosen-js' defer></script>
<script src='https://digital-deck.com/wp-includes/js/jquery/ui/core.js?ver=1.13.1' id='jquery-ui-core-js' defer>
</script>
<script src='https://digital-deck.com/wp-includes/js/jquery/ui/datepicker.js?ver=1.13.1' id='jquery-ui-datepicker-js'
    defer></script>
<script src='https://digital-deck.com/wp-includes/js/imagesloaded.min.js?ver=4.1.4' id='imagesloaded-js' defer></script>
<script id='premium-addons-js-extra'>
    var PremiumSettings = {
        "ajaxurl": "https:\/\/digital-deck.com\/wp-admin\/admin-ajax.php",
        "nonce": "80a45cfe9b"
    };
</script>
<script
    src='https://digital-deck.com/wp-content/plugins/premium-addons-for-elementor/assets/frontend/js/premium-addons.js?ver=4.9.37'
    id='premium-addons-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/powerpack-elements/assets/js/frontend-devices.js?ver=2.9.6'
    id='powerpack-devices-js' defer></script>
<script id='powerpack-frontend-js-extra'>
    var ppLogin = {
        "empty_username": "Enter a username or email address.",
        "empty_password": "Enter password.",
        "empty_password_1": "Enter a password.",
        "empty_password_2": "Re-enter password.",
        "empty_recaptcha": "Please check the captcha to verify you are not a robot.",
        "email_sent": "A password reset email has been sent to the email address for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.",
        "reset_success": "Your password has been reset successfully.",
        "ajax_url": "https:\/\/digital-deck.com\/wp-admin\/admin-ajax.php"
    };
    var ppRegistration = {
        "invalid_username": "This username is invalid because it uses illegal characters. Please enter a valid username.",
        "username_exists": "This username is already registered. Please choose another one.",
        "empty_email": "Please type your email address.",
        "invalid_email": "The email address isn\u2019t correct!",
        "email_exists": "The email is already registered, please choose another one.",
        "password": "Password must not contain the character \"\\\\\"",
        "password_length": "Your password should be at least 8 characters long.",
        "password_mismatch": "Password does not match.",
        "invalid_url": "URL seems to be invalid.",
        "recaptcha_php_ver": "reCAPTCHA API requires PHP version 5.3 or above.",
        "recaptcha_missing_key": "Your reCAPTCHA Site or Secret Key is missing!",
        "show_password": "Show password",
        "hide_password": "Hide password",
        "ajax_url": "https:\/\/digital-deck.com\/wp-admin\/admin-ajax.php"
    };
    var ppCoupons = {
        "copied_text": "Copied"
    };
</script>
<script src='https://digital-deck.com/wp-content/plugins/powerpack-elements/assets/js/frontend.js?ver=2.9.6'
    id='powerpack-frontend-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor-pro/assets/js/webpack-pro.runtime.js?ver=3.8.1'
    id='elementor-pro-webpack-runtime-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor/assets/js/webpack.runtime.js?ver=3.8.0'
    id='elementor-webpack-runtime-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor/assets/js/frontend-modules.js?ver=3.8.0'
    id='elementor-frontend-modules-js' defer></script>
<script src='https://digital-deck.com/wp-includes/js/dist/vendor/regenerator-runtime.js?ver=0.13.9'
    id='regenerator-runtime-js' defer></script>
<script src='https://digital-deck.com/wp-includes/js/dist/vendor/wp-polyfill.js?ver=3.15.0' id='wp-polyfill-js'>
</script>
<script src='https://digital-deck.com/wp-includes/js/dist/hooks.js?ver=c6d64f2cb8f5c6bb49caca37f8828ce3'
    id='wp-hooks-js'></script>
<script src='https://digital-deck.com/wp-includes/js/dist/i18n.js?ver=ebee46757c6a411e38fd079a7ac71d94' id='wp-i18n-js'>
</script>
<script id='wp-i18n-js-after'>
    wp.i18n.setLocaleData({
        'text direction\u0004ltr': ['ltr']
    });
</script>
<script id='elementor-pro-frontend-js-before'>
    var ElementorProFrontendConfig = {
        "ajaxurl": "https:\/\/digital-deck.com\/wp-admin\/admin-ajax.php",
        "nonce": "fa37d3211b",
        "urls": {
            "assets": "https:\/\/digital-deck.com\/wp-content\/plugins\/elementor-pro\/assets\/",
            "rest": "https:\/\/digital-deck.com\/wp-json\/"
        },
        "shareButtonsNetworks": {
            "facebook": {
                "title": "Facebook",
                "has_counter": true
            },
            "twitter": {
                "title": "Twitter"
            },
            "linkedin": {
                "title": "LinkedIn",
                "has_counter": true
            },
            "pinterest": {
                "title": "Pinterest",
                "has_counter": true
            },
            "reddit": {
                "title": "Reddit",
                "has_counter": true
            },
            "vk": {
                "title": "VK",
                "has_counter": true
            },
            "odnoklassniki": {
                "title": "OK",
                "has_counter": true
            },
            "tumblr": {
                "title": "Tumblr"
            },
            "digg": {
                "title": "Digg"
            },
            "skype": {
                "title": "Skype"
            },
            "stumbleupon": {
                "title": "StumbleUpon",
                "has_counter": true
            },
            "mix": {
                "title": "Mix"
            },
            "telegram": {
                "title": "Telegram"
            },
            "pocket": {
                "title": "Pocket",
                "has_counter": true
            },
            "xing": {
                "title": "XING",
                "has_counter": true
            },
            "whatsapp": {
                "title": "WhatsApp"
            },
            "email": {
                "title": "Email"
            },
            "print": {
                "title": "Print"
            }
        },
        "facebook_sdk": {
            "lang": "en_US",
            "app_id": ""
        },
        "lottie": {
            "defaultAnimationUrl": "https:\/\/digital-deck.com\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"
        }
    };
</script>
<script src='https://digital-deck.com/wp-content/plugins/elementor-pro/assets/js/frontend.js?ver=3.8.1'
    id='elementor-pro-frontend-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.js?ver=4.0.2'
    id='elementor-waypoints-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor/assets/lib/swiper/swiper.js?ver=5.3.6' id='swiper-js'
    defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor/assets/lib/share-link/share-link.js?ver=3.8.0'
    id='share-link-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor/assets/lib/dialog/dialog.js?ver=4.9.0'
    id='elementor-dialog-js' defer></script>
<script id='elementor-frontend-js-extra'>
    var uael_particles_script = {
        "uael_particles_url": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/min-js\/uael-particles.min.js",
        "particles_url": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/lib\/particles\/particles.min.js",
        "snowflakes_image": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/img\/snowflake.svg",
        "gift": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/img\/gift.png",
        "tree": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/img\/tree.png",
        "skull": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/img\/skull.png",
        "ghost": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/img\/ghost.png",
        "moon": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/img\/moon.png",
        "bat": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/img\/bat.png",
        "pumpkin": "https:\/\/digital-deck.com\/wp-content\/plugins\/ultimate-elementor\/assets\/img\/pumpkin.png"
    };
</script>
<script id='elementor-frontend-js-before'>
    var elementorFrontendConfig = {
        "environmentMode": {
            "edit": false,
            "wpPreview": false,
            "isScriptDebug": true
        },
        "i18n": {
            "shareOnFacebook": "Share on Facebook",
            "shareOnTwitter": "Share on Twitter",
            "pinIt": "Pin it",
            "download": "Download",
            "downloadImage": "Download image",
            "fullscreen": "Fullscreen",
            "zoom": "Zoom",
            "share": "Share",
            "playVideo": "Play Video",
            "previous": "Previous",
            "next": "Next",
            "close": "Close"
        },
        "is_rtl": false,
        "breakpoints": {
            "xs": 0,
            "sm": 480,
            "md": 768,
            "lg": 1025,
            "xl": 1440,
            "xxl": 1600
        },
        "responsive": {
            "breakpoints": {
                "mobile": {
                    "label": "Mobile",
                    "value": 767,
                    "default_value": 767,
                    "direction": "max",
                    "is_enabled": true
                },
                "mobile_extra": {
                    "label": "Mobile Extra",
                    "value": 880,
                    "default_value": 880,
                    "direction": "max",
                    "is_enabled": false
                },
                "tablet": {
                    "label": "Tablet",
                    "value": 1024,
                    "default_value": 1024,
                    "direction": "max",
                    "is_enabled": true
                },
                "tablet_extra": {
                    "label": "Tablet Extra",
                    "value": 1200,
                    "default_value": 1200,
                    "direction": "max",
                    "is_enabled": false
                },
                "laptop": {
                    "label": "Laptop",
                    "value": 1366,
                    "default_value": 1366,
                    "direction": "max",
                    "is_enabled": false
                },
                "widescreen": {
                    "label": "Widescreen",
                    "value": 2400,
                    "default_value": 2400,
                    "direction": "min",
                    "is_enabled": false
                }
            }
        },
        "version": "3.8.0",
        "is_static": false,
        "experimentalFeatures": {
            "e_import_export": true,
            "e_hidden_wordpress_widgets": true,
            "theme_builder_v2": true,
            "landing-pages": true,
            "elements-color-picker": true,
            "favorite-widgets": true,
            "admin-top-bar": true,
            "page-transitions": true,
            "notes": true,
            "form-submissions": true,
            "e_scroll_snap": true
        },
        "urls": {
            "assets": "https:\/\/digital-deck.com\/wp-content\/plugins\/elementor\/assets\/"
        },
        "settings": {
            "page": [],
            "editorPreferences": []
        },
        "kit": {
            "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
            "global_image_lightbox": "yes",
            "lightbox_enable_counter": "yes",
            "lightbox_enable_fullscreen": "yes",
            "lightbox_enable_zoom": "yes",
            "lightbox_enable_share": "yes",
            "lightbox_title_src": "title",
            "lightbox_description_src": "description"
        },
        "post": {
            "id": 263,
            "title": "Home%20%7C%20Digital%20Deck%20%7C%20Be%20Digital%20Now%20%28It%27s%20Easier%20Than%20Ever%29",
            "excerpt": "",
            "featuredImage": false
        }
    };
</script>
<script src='https://digital-deck.com/wp-content/plugins/elementor/assets/js/frontend.js?ver=3.8.0'
    id='elementor-frontend-js' defer></script>
<script id='elementor-frontend-js-after'>
    window.addEventListener('DOMContentLoaded', function() {
        window.scope_array = [];
        window.backend = 0;
        jQuery.cachedScript = function(url, options) {
            // Allow user to set any option except for dataType, cache, and url.
            options = jQuery.extend(options || {}, {
                dataType: "script",
                cache: true,
                url: url
            });
            // Return the jqXHR object so we can chain callbacks.
            return jQuery.ajax(options);
        };
        jQuery(window).on("elementor/frontend/init", function() {
            elementorFrontend.hooks.addAction("frontend/element_ready/global", function($scope, $) {
                if ("undefined" == typeof $scope) {
                    return;
                }
                if ($scope.hasClass("uael-particle-yes")) {
                    window.scope_array.push($scope);
                    $scope.find(".uael-particle-wrapper").addClass("js-is-enabled");
                } else {
                    return;
                }
                if (elementorFrontend.isEditMode() && $scope.find(".uael-particle-wrapper")
                    .hasClass("js-is-enabled") && window.backend == 0) {
                    var uael_url = uael_particles_script.uael_particles_url;

                    jQuery.cachedScript(uael_url);
                    window.backend = 1;
                } else if (elementorFrontend.isEditMode()) {
                    var uael_url = uael_particles_script.uael_particles_url;
                    jQuery.cachedScript(uael_url).done(function() {
                        var flag = true;
                    });
                }
            });
        });
        jQuery(document).on("ready elementor/popup/show", () => {
            if (jQuery.find(".uael-particle-yes").length < 1) {
                return;
            }
            var uael_url = uael_particles_script.uael_particles_url;
            jQuery.cachedScript = function(url, options) {
                // Allow user to set any option except for dataType, cache, and url.
                options = jQuery.extend(options || {}, {
                    dataType: "script",
                    cache: true,
                    url: url
                });
                // Return the jqXHR object so we can chain callbacks.
                return jQuery.ajax(options);
            };
            jQuery.cachedScript(uael_url);
        });
    });
</script>
<script
    src='https://digital-deck.com/wp-content/plugins/elementor-pro/assets/js/preloaded-elements-handlers.js?ver=3.8.1'
    id='pro-preloaded-elements-handlers-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor/assets/js/preloaded-modules.js?ver=3.8.0'
    id='preloaded-modules-js' defer></script>
<script src='https://digital-deck.com/wp-content/plugins/elementor-pro/assets/lib/sticky/jquery.sticky.js?ver=3.8.1'
    id='e-sticky-js' defer></script>
<script src='https://digital-deck.com/wp-includes/js/underscore.min.js?ver=1.13.3' id='underscore-js' defer></script>
<script id='wp-util-js-extra'>
    var _wpUtilSettings = {
        "ajax": {
            "url": "\/wp-admin\/admin-ajax.php"
        }
    };
</script>
<script src='https://digital-deck.com/wp-includes/js/wp-util.js?ver=6.0.3' id='wp-util-js' defer></script>
<script id='wpforms-elementor-js-extra'>
    var wpformsElementorVars = {
        "captcha_provider": "recaptcha",
        "recaptcha_type": "v2"
    };
</script>
<script
    src='https://digital-deck.com/wp-content/plugins/wpforms/assets/js/integrations/elementor/frontend.min.js?ver=1.7.8'
    id='wpforms-elementor-js' defer></script>
<script
    src='https://digital-deck.com/wp-content/plugins/powerpack-elements/assets/lib/tooltipster/tooltipster.js?ver=2.9.6'
    id='pp-tooltipster-js' defer></script>