function formatDateTime(dateTimeString) {
    const options = {
        year: "numeric",
        month: "short",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
    };

    const formatDateTime = new Intl.DateTimeFormat("vi", options).format(
        new Date(dateTimeString)
    );
    return formatDateTime;
}

function autoScrollToBottom() {
    chat_are_body.scrollTop(chat_are_body.prop("scrollHeight"));
}

window.Echo.private("message." + USER.id).listen("MessageEvent", (e) => {
    // console.log(e);
    let chat_are_body = $(".chat_body_dashboard_user");

    // show message receiver send sender
    if (chat_are_body.attr("data-inbox") == e.sender_id) {
        var message = `<div class="wsus__chat_single">
    <div class="wsus__chat_single_img">
        <img src="${e.vendor_banner}"
            alt="user" class="img-fluid">
    </div>
    <div class="wsus__chat_single_text">
        <p>${e.message}</p>
        <span>${formatDateTime(e.date_time)}</span>
    </div>
    </div>`;
    }

    chat_are_body.append(message);

    autoScrollToBottom();

    // add notification to avatar_image
    $(".chat-receiver-profile").each(function (index, value) {
        let receiver_id = $(this).data("id");
        if (receiver_id == e.sender_id) {
            $(this).find(".wsus_chat_list_img").addClass("msg-notification");
        }
    });
});
