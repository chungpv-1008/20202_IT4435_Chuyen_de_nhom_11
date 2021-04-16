<div class="banner_1">
    <div class="container">
        <div id="search_wrapper1">
            <div id="search_form" class="clearfix">
                <h1>@lang('home.search_title')</h1>
                <p>
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="title" class="text" placeholder="@lang('layout.keywords')" value="">
                    <input type="text" name="name" class="text" placeholder="@lang('layout.company')" value="">
                    <label class="btn2 btn-2 btn2-1b"><input type="submit" value="@lang('layout.find')"></label>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>
