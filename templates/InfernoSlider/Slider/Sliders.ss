<% if $AmountBanners == 1 %>
    <% if SingleBanner %><div class="full-height d-none d-md-block" style=" height:70vh;">
        <div class="Banner-Image" style="background-image:url('{$SingleBanner.URL}');
            background-position: $SingleBanner.PercentageX% $SingleBanner.PercentageY%;height:100%;background-size:cover;"></div>
        <% if $SingleContent %>
            <div class="container">

                <div class="carousel-caption carousel-caption-single" style="


                    <% if OverlayWidth = 'width:50%;' %>
                    border-top-right-radius: 10px;
                        border-bottom-right-radius: 10px;
                    <% end_if %>
                    ">
                    <div class="container">
                <div class="col-md-5">
                    $SingleContent
                </div>
                    </div>
                </div>

            </div>
        <% end_if %>
    </div>
    <div class="full-height d-block d-md-none" style=" height:100vh;">
        <div class="Banner-Image" style="background-image:url('{$SingleBannerMobile.URL}');
            background-position: $SingleBanner.PercentageX% $SingleBanner.PercentageY%;height:100%;background-size:cover;"></div>
        <% if $SingleContent %>
            <div class="container">

                <div class="carousel-caption carousel-caption-single" style="

                    margin-top:10%;
                    <% if OverlayWidth = 'width:50%;' %>
                    border-top-right-radius: 10px;
                        border-bottom-right-radius: 10px;
                    <% end_if %>
                    ">
                <div class="container">
                    <div class="col-md-12">
                    $SingleContent
                    </div>
                </div>
                </div>

            </div>
        <% end_if %>
    </div>
    <% end_if %>
<% else_if $AmountBanners == 2 %>

    <% if $getPageBannerRecursive %>

        <!--Desktop Sliders-->
        <div id="myDesktopCarousel" class="carousel slide d-none d-md-block" data-ride="carousel">
            <ol class="carousel-indicators">
                <% loop Banners %>
                <li data-target="#myDesktopCarousel" data-slide-to="$Pos(0)" <% if $First %>class="active"<% else %>class="" <% end_if %></li>
                <% end_loop %>
            </ol>
            <div class="carousel-inner">
                <% loop Banners %>
                    <div class="carousel-item <% if $First %>active<% end_if %>">
                        <% if $LinkPage.Link !='' %>
                        <a href="$LinkPage.Link"><% else %><% end_if %><img src="$Banner.URL" class="img-fluid" data-pagespeed-no-transform /><% if $LinkPage.Link !='' %></a><% end_if %>
                        <% if $Caption %>
                            <div class="container">
                                <div class="carousel-caption d-none d-md-block" style="

                                    background:$OverlayColor.CSSColor($OverlayOpacity);
                                    top:35%;
                                    bottom:auto;
                                    text-align:$Alignment();
                                    color: #$TextColor;
                                    <% if OverlayWidth = 'width:50%;' %>
                                        width:40%;
                                    border-top-right-radius: 10px;
                                        border-bottom-right-radius: 10px;
                                    <% end_if %>
                                    ">
                                    $Caption
                                </div>
                            </div>
                        <% end_if %>
                    </div>
                <% end_loop %>
            </div>
            <% loop Banners %>
                <% if $TotalItems > 1 %>
                    <a class="carousel-control-prev" href="" data-target="#myDesktopCarousel" id="#myDesktopCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="" data-target="#myDesktopCarousel" id="myDesktopCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                <% end_if %>
            <% end_loop %>
        </div>


        <!--Mobile Sliders-->
        <div id="myMobileCarousel" class="carousel slide d-block d-md-none" data-ride="carousel">
            <ol class="carousel-indicators">
                <% loop Banners %>
                <li data-target="#myMobileCarousel" data-slide-to="$Pos(0)" <% if $First %>class="active"<% else %>class="" <% end_if %></li>
                <% end_loop %>
            </ol>
            <div class="carousel-inner">
                <% loop Banners %>
                    <div class="carousel-item <% if $First %>active<% end_if %>">
                        <% if $LinkPage.Link !='' %>
                        <a href="$LinkPage.Link"><% else %><% end_if %><img style="width:100%;" <% if $MobileBanner %>src="$MobileBanner.URL"<% else %>src="$Banner.CroppedFocusedImage(400,600).URL"<% end_if %> class="img-fluid" data-pagespeed-no-transform /><% if $LinkPage.Link !='' %></a><% end_if %>
                        <div class="container">
                            <div class="carousel-caption">
                                $Caption
                            </div>
                        </div>
                    </div>
                <% end_loop %>
            </div>
            <% loop Banners %>
                <% if $TotalItems > 1 %>
                    <a class="carousel-control-prev" href="" data-target="#myMobileCarousel" id="#myMobileCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="" data-target="#myMobileCarousel" id="myMobileCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                <% end_if %>
            <% end_loop %>
        </div>
    <% end_if %>
<% end_if %>
