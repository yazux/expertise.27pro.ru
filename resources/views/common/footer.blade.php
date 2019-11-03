<footer class="footer">

    @if(\Request::route() && \Request::route()->getName() != 'home' && isset($RegionId))
        <div class="content footer__container">
            <div class="footer__contacts w-25">
                <p class="footer__contacts-title">Контакты</p>
                <div class="footer__contacts-container no-flex">
                    @if(setting('site.footer_phone_1'))
                        <a class="footer_link" href="tel:{{setting('site.footer_phone_1')}}">{{setting('site.footer_phone_1')}}</a>
                    @endif
                    @if(setting('site.footer_phone_2'))
                        <a class="footer_link" href="tel:{{setting('site.footer_phone_2')}}">{{setting('site.footer_phone_2')}}</a>
                    @endif
                    @if(setting('site.footer_phone_3'))
                        <a class="footer_link" href="tel:{{setting('site.footer_phone_3')}}">{{setting('site.footer_phone_3')}}</a>
                    @endif
                
                    @if(setting('site.foolter_email_1'))
                        <a class="footer_link" href="mailto:{{setting('site.foolter_email_1')}}">{{setting('site.foolter_email_1')}}</a>
                    @endif
                    @if(setting('site.foolter_email_2'))
                        <a class="footer_link" href="mailto:{{setting('site.foolter_email_2')}}">{{setting('site.foolter_email_2')}}</a>
                    @endif
                    @if(setting('site.foolter_email_3'))
                        <a class="footer_link" href="mailto:{{setting('site.foolter_email_3')}}">{{setting('site.foolter_email_3')}}</a>
                    @endif
                
                    @if(setting('site.footer_address'))
                        <p class="footer_address">{!! setting('site.footer_address') !!}</p>
                    @endif
                </div>
            </div>
            <div class="footer_news w-75">
                <news-list id="news-list" :region-id="{{$RegionId}}"></news-list>
            </div>
        </div>
    @else
        <div class="content footer__container">
            <div class="footer__contacts">
                <p class="footer__contacts-title">Контакты</p>
                <div class="footer__contacts-container">
                    <div class="footer__contacts-side">
                        @if(setting('site.footer_phone_1'))
                            <a class="footer_link" href="tel:{{setting('site.footer_phone_1')}}">{{setting('site.footer_phone_1')}}</a>
                        @endif
                        @if(setting('site.footer_phone_2'))
                            <a class="footer_link" href="tel:{{setting('site.footer_phone_2')}}">{{setting('site.footer_phone_2')}}</a>
                        @endif
                        @if(setting('site.footer_phone_3'))
                            <a class="footer_link" href="tel:{{setting('site.footer_phone_3')}}">{{setting('site.footer_phone_3')}}</a>
                        @endif
                    </div>
                    <div class="footer__contacts-side emails">
                        @if(setting('site.foolter_email_1'))
                            <a class="footer_link" href="mailto:{{setting('site.foolter_email_1')}}">{{setting('site.foolter_email_1')}}</a>
                        @endif
                        @if(setting('site.foolter_email_2'))
                            <a class="footer_link" href="mailto:{{setting('site.foolter_email_2')}}">{{setting('site.foolter_email_2')}}</a>
                        @endif
                        @if(setting('site.foolter_email_3'))
                            <a class="footer_link" href="mailto:{{setting('site.foolter_email_3')}}">{{setting('site.foolter_email_3')}}</a>
                        @endif

                        @if(setting('site.footer_file_link') && setting('site.footer_file_name'))
                            <?
                                $file = null;
                                if (is_string(setting('site.footer_file_link'))) $file = json_decode(setting('site.footer_file_link'), true);
                                if (isset($file[0])) $file = $file[0];
                                if (isset($file['download_link'])) $file = $file['download_link'];
                            ?>
                            @if($file)
                                <a href="{{ '/storage/' . $file  }}" target="_blank" class="footer__contacts-link">{{setting('site.footer_file_name')}}</a>
                            @endif

                        @endif

                    </div>
                    <div class="footer__contacts-side">
                        @if(setting('site.footer_address'))
                            <p class="footer_address">{!! setting('site.footer_address') !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <access id="access" :enable="{{(setting('site.password_enable')) ? 1 : 0}}" :region-id="{{(isset($RegionId) && $RegionId) ? $RegionId : 0}}"></access>
</footer>