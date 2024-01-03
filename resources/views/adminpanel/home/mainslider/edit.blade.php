@section('title', 'Main Slider')
<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon">
        </div>
        <!-- END RIBBON -->
        <div id="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row cms_top_btn_row" style="margin-left:auto;margin-right:auto;">
                        <a href="{{ route('main-slider') }}">
                            <button class="btn cms_top_btn top_btn_height ">{{ __('Add New') }}</button>
                        </a>

                        <a href="{{ route('main-slider-list') }}">
                            <button class="btn cms_top_btn top_btn_height ">{{ __('View All') }}</button>
                        </a>
                    </div>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
                <header>
                    <h2>{{ __('Main Slider') }}</h2>
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <form action="{{ route('save-main-slider') }}" enctype="multipart/form-data" method="post" id="main-slider-form" class="smart-form">
                        @csrf
                        @method('PUT')
                            <fieldset>
                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label">{{ __('Heading 1 English') }} <span style=" color: red;">*</span> </label>
                                        <label class="input">
                                            <input type="text" id="heading_1_en" name="heading_1_en" required value="{{ $data->heading_1_en }}">
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">{{ __('Heading 1 Sinhala') }} </label>
                                        <label class="input">
                                            <input type="text" id="heading_1_si" name="heading_1_si" value="{{ $data->heading_1_si }}">
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">{{ __('Heading 1 Tamil') }} </label>
                                        <label class="input">
                                            <input type="text" id="heading_1_ta" name="heading_1_ta" value="{{ $data->heading_1_ta }}">
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label">{{ __('Heading 2 English') }} <span style=" color: red;">*</span> </label>
                                        <label class="input">
                                            <input type="text" id="heading_2_en" name="heading_2_en" required value="{{ $data->heading_2_en }}">
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">{{ __('Heading 2 Sinhala') }} </label>
                                        <label class="input">
                                            <input type="text" id="heading_2_si" name="heading_2_si" value="{{ $data->heading_2_si }}">
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">{{ __('Heading 2 Tamil') }} </label>
                                        <label class="input">
                                            <input type="text" id="heading_2_ta" name="heading_2_ta" value="{{ $data->heading_2_ta }}">
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <div class="input-group hdtutodocument control-group lstdocument incrementdocument" style="width: 100%;">
                                        <section class="col col-6">
                                            <label class="label">{{ __('Thumbnail (1200 * 800)') }} </label>
                                            <label class="input">
                                                <input type="file" id="file" name="file" required value="">
                                            </label>
                                        </section>
                                    </div>
                                </div>                                                                                
                                <section class="col col-4">
                                    <img id="preview-image-before-upload" src="../../storage/app/public/latest_updates/{{ $data->image }}" alt="preview image" style="max-height: 150px;">
                                </section>

                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label">{{ __('Status') }}</label>
                                        <label class="select">
                                            <select name="status" id="status">
                                                <option value="Y" {{ $data->status == 'Y' ? "selected" : "" }}>{{ __('Active') }}</option>
                                                <option value="N" {{ $data->status == 'N' ? "selected" : ""  }}>{{ __('Inactive') }}</option>
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <input type="hidden" name="id" value="{{ $data->id }}>">
                                <button id="button1id" name="button1id" type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                                <button type="button" class="btn btn-default" onclick="window.history.back();">
                                    {{ __('Back') }}
                                </button>
                            </footer>
                        </form>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </div>
    </div>
    <x-slot name="script">
        <script>
            $(function(){
                $('#main-slider-form').parsley();
            });
        </script>
    </x-slot>
</x-app-layout>
