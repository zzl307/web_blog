window.replyComment = function (obj, username, comment_id) {
    let oldForm = $('#comment-reply-form');
    if (oldForm.length >= 0) {
        let check = $(obj).parent().parent().find('> #comment-reply-form');
        if (check.is(oldForm)) {
            oldForm.remove();
            return
        }
        oldForm.remove();
    }
    let html = $('#comment-form-wrapper').clone();
    let form = html.find('#comment-form');
    form.attr('id', 'comment-reply-form');
    form.find('#comment_submit_msg').text('');
    form.append('<input type="hidden" name="reply_id" value=' + comment_id + '>');

    $(obj).parent().after(html.html());

    let comment_reply_form = $('#comment-reply-form')
    let contentTextarea = comment_reply_form.find('#comment-content');
    contentTextarea.focus().val("").val('@' + username + ' ');
    Xblog.bindCommentFrom(comment_reply_form);
};

window.deleteComment = function (comment_id) {
    dialog({
            body: '确定删除这条评论?',
        },
        function () {
            $.ajax({
                method: 'delete',
                url: /comment/ + comment_id,
                headers: {
                    'X-CSRF-TOKEN': XblogConfig.csrfToken
                },
            }).done(function (data) {
                if (data.status === 200) {
                    $('#comment-' + comment_id).remove();
                } else {
                    dialog({
                        title: "错误",
                        body: '删除失败',
                        type: "danger",
                    })
                }
            }).fail(function () {
                setTimeout(function () {
                    dialog({
                        title: "错误",
                        body: '删除失败',
                        type: "danger",
                    })
                }, 4500)
            });
        });
};