<footer class="footer" id="footer">
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <span>Copyright © <a href="{{ route('index') }}">{{ $site_title or '' }}</a></span> |
                    @if(isset($case_number))
                        <span>{{ $case_number }}</span> |
                    @endif
                    <span>Powered by <a href="https://github.com/lufficc/Xblog">Xblog</a> </span>|
                    <a href="{{ url('feed.xml') }}" rel="feed" type="application/rss+xml"
                       title="Feed"><img width="13"
                                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAxlBMVEVHcEzMXBTPYRnMXBTMXBTMXBTPYRn3mkLujkn2kzb6mzjpeS/uhDLlcS3cYSrbXSngfDPbdCv7ypv6w474pVb1m0zicTn6oUToh0DndS/7voD/+fP////4w5nzjjX4lzf83L71kDbxizT74cz+7Nr6s2z7nTnofzn98Ob1qWr60q/um2b7rl3rfjD0kj/95tP+8+bhaSzfZSrjbS33lTfsgTH0vJf5mTjxroHwhjPtgDL20b7yjTTvspX0kDXvhzPwiTPliV9ZOqM5AAAAB3RSTlMAEL+vUJ/PQJMZEQAAAbtJREFUeF51k+V6wzAMRbMsqcPMZWYYM73/S+1Kbtd2X6pfac+xfOXECkprhEFNhQ1NobrSA2Nalra9Xj84ztf34L3zaZr33SeRBvoVhOti6ro1/MmyRKGjf3CRTyYi0JSGAW4sl0YNt7qpqoRTrH9soYZR8p+bm1AJkA+CrFkszni/E0DA/ixwNeMzPoAADuFYo+SEv5Ag88/j3qFJdeQOhON8otpJpfrjrxDO5o+b0jjwNQTi7dYMQ1L+ZMTGeM9tCLS+zf8Ox8ifbzlHKjkL6A+Bq5cjHxtDyUsItD8EWbvVxBK8y5y5C4HypfNoP2Rz1TUTPlTmJBzOP1nIHqLf4YbPxO8gHN/PmGdcdAYbehgSv4Fw8v5WbMxfHD76ApwE5nkcxfnEGvMozqvBe4DfQuD1FHyUd03OYaxtGvUNnAXwSh6w2U95qfxAZuAeBNo/YiHC+VKrhV0u6Tc4CZxfdsD5t2V+FjLP8yFw/h4tBHdI2LpuRsKP56NDKPj7WcUJOPI/ojDfByrz/SxUGunJ9yPPHxz50N/3DRUXR1zmGS6OohfiIp/q8vKmmxruZQZfXpSm1l9/VQP8BWCicP2VITteAAAAAElFTkSuQmCC"
                                         alt="Feed"></a>
                </div>
            </div>
        </div>
    </div>
</footer>