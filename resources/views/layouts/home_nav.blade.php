<ul class="menu_r">
    @foreach($navs as $k=>$v)
    <li><a href="{{url($v['nav_url'])}}">{{($v['nav_name'])}}</a></li>
    @endforeach
</ul>