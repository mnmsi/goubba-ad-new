<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ad Preview</title>

    <!-- BOOTSTRAP CSS -->
	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet"/>

    <style>
        html {
            overflow: scroll;
            overflow-x: hidden;
        }
        ::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }

        * {
            font-size: 12px;
        }

        header.fixed {
            margin: 0;
            padding: 0;
        }

        .story-section {
            height: 60px;
            border-bottom: solid 1px #ddd;
            margin-bottom:3px;
        }

        .horizontal-scroll-wrapper{
            position: absolute;
            width:60px;
            max-height: 266px;
            overflow-y:auto;
            overflow-x:hidden;
            white-space: nowrap;
            transform:rotate(-90deg) translateY(-80px);
            transform-origin:right top;
            padding-top: 70px;
            padding-right: 5px;
            margin-left: 11px;
        }

        .horizontal-scroll-wrapper > div{
            display:block;
            transform:rotate(90deg);
            transform-origin: right top;
        }

        .img-border img {
            border: #96469f 2px solid;
            /* box-shadow: 0px 0px 6px 2px rgb(65 65 65 / 17%) */
        }

        .sotry-title {
            font-size: 9px;
        }

        .custom-card {
            border: none;
            margin: 5px;
            border-radius: 10px;
            box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.16);
        }

        .story-item {
            height: auto;
            width: 35px;
            border-radius: 50%;
            box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.16);
        }

        .subtitle {
            margin-top: -5px;
            font-size: 9px;
        }

    </style>

</head>
<body>

    <header class="fixed-top bg-white">
        <img src="{{ asset('assets/preview/header.svg') }}" alt="" width="100%">
    </header>
    <br><br><br>

    @if ($type == 'banner')
        <section>
            <div class="story-section">
                <img src="{{ $file }}" alt="" width="100%">
            </div>
        </section>
    @else
        <section>
            <div class="story-section">
                <img src="{{ asset('assets/preview/promotionheader.gif') }}" alt="" width="100%">
            </div>
        </section>
    @endif


    <section>
        <div class="story-section">
            <div class="horizontal-scroll-wrapper">
                @if ($type == 'story')
                    <div class="text-center img-border">
                        <img src="{{ $file }}" class="story-item" />
                        <div class="sotry-title">{{ $title }}</div>
                    </div>
                @endif
                <div class="text-center">
                    <img src="{{ asset('assets/preview/story-1.svg') }}" class="story-item" />
                    <div class="sotry-title">Yasir</div>
                </div>
                <div class="text-center">
                    <img src="{{ asset('assets/preview/story-2.svg') }}" class="story-item" />
                    <div class="sotry-title">Food</div>
                </div>
                <div class="text-center">
                    <img src="{{ asset('assets/preview/story-3.svg') }}" class="story-item" />
                    <div class="sotry-title">Ietem</div>
                </div>
                <div class="text-center">
                    <img src="{{ asset('assets/preview/story-4.svg') }}" class="story-item" />
                    <div class="sotry-title">Iout</div>
                </div>
                <div class="text-center">
                    <img src="{{ asset('assets/preview/story-5.svg') }}" class="story-item" />
                    <div class="sotry-title">Front</div>
                </div>
                <div class="text-center">
                    <img src="{{ asset('assets/preview/story-1.svg') }}" class="story-item" />
                    <div class="sotry-title">Yasir</div>
                </div>
                <div class="text-center">
                    <img src="{{ asset('assets/preview/story-2.svg') }}" class="story-item" />
                    <div class="sotry-title">Amia</div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            @if ($type == 'native')
            @for ($i = 1; $i < $position + 3; $i++)
                @php
                    $rand = rand(1, 2);
                @endphp

                @if ($i == $position)
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-body p-0">
                            <div class="row pt-3 pl-3 pr-3 mb-2">
                                <div class="pl-3">
                                    <img src="{{ $logo }}" alt="" style="border-radius: 50%" width="35px" height="auto">
                                </div>
                                <div class="pl-2">
                                    <h5 class="">{{ $title }}</h5>
                                    <h6 class="mb-2 text-muted subtitle">Sponsored</h6>
                                </div>
                                <div class="ml-auto mr-3">
                                    <a href="javascript:void(0)"><i class="fe fe-info"></i></a>
                                    <a href="javascript:void(0)"><i class="fe fe-alert-triangle"></i></a>
                                </div>
                            </div>
                            <div>
                                <img src="{{ $file }}" alt="" width="100%" height="auto">
                            </div>
                            <div class="row m-4">
                                <a href="{{ $link }}" type="button" class="btn btn-outline-info font-weight-bold w-100" target="balnk">Open Link</a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <img src="{{ asset('assets/preview/card-item-'. $rand .'.svg') }}" alt="" width="100%">
                </div>
                @endif
            @endfor
            @else
                <div class="col-md-12">
                    <img src="{{ asset('assets/preview/card-item-1.svg') }}" alt="" width="100%">
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/preview/card-item-2.svg') }}" alt="" width="100%">
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/preview/card-item-1.svg') }}" alt="" width="100%">
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/preview/card-item-2.svg') }}" alt="" width="100%">
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/preview/card-item-1.svg') }}" alt="" width="100%">
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/preview/card-item-2.svg') }}" alt="" width="100%">
                </div>
            @endif
        </div>
    </section>

    <!-- JQUERY JS -->
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>

</body>
</html>
