@extends('admin.layouts.app')
@section('title', '服务器详情')
@section('content')
    <div>
        <h4>配置</h4>
        <table class="table table-striped table-bordered">
            <tbody>
            <tr>
                <th>Laravel 版本</th>
                <td>{{ app()->version() }}</td>
                <th>App 名称</th>
                <td>{{ config('app.name') }}</td>

            </tr>
            <tr>
                <th>邮件名称</th>
                <td>{{ config('mail.username') }}</td>
                <th>邮件密码</th>
                <td>{{ config('mail.password') ? '******' : '' }}</td>

            </tr>
            <tr>
                <th>邮件地址</th>
                <td>{{ config('mail.host') }}</td>
                <th>邮件端口</th>
                <td>{{ config('mail.port') }}</td>
            </tr>
            <tr>
                <th>数据库</th>
                <td>{{ config('database.default') }}</td>
                <th>数据库名称</th>
                <td>{{ config('database.connections.'.config('database.default').'.database') }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div>
        <h4>测试邮件</h4>
        <form method="post" action="{{ route('admin.app.send-mail') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email">发送给</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="content">邮件内容</label>
                <textarea name="content" class="autosize-target form-control" id="content" rows="3" placeholder="邮件内容"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">发送测试邮件</button>
        </form>
    </div>
    <div class="mt-3">
        <h4>
            Failed Jobs
            @if(!$failed_jobs->isEmpty())
                <a class="btn btn-outline-success swal-dialog-target"
                   data-toggle="tooltip"
                   data-placement="right"
                   title="Delete all failed jobs"
                   data-dialog-title="Failed Jobs"
                   data-dialog-msg="Flush {{ count($failed_jobs) }} failed jobs ?"
                   data-url="{{ route('admin.failed-jobs.flush') }}">
                    Flush
                </a>
            @endif
        </h4>
        @if($failed_jobs->isEmpty())
            <div style="text-align: center;"> Congratulations! You don't have failed jobs.</div>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Connection</th>
                    <th>Date</th>
                    <th>Exception</th>
                </tr>
                </thead>
                <tbody>
                @foreach($failed_jobs as $failed_job)
                    <tr>
                        <td>{{ $failed_job->id }}</td>
                        <td>{{ $failed_job->connection }}</td>
                        <td>{{ $failed_job->failed_at }}</td>
                        <td title="{{ $failed_job->exception }}">Hover Me</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
