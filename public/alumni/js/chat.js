(function ($) {
    "use strict";

    $(document).on('input', "#chat-search-field", function (event) {
        let searchValue = $(this).val();
        clearTimeout(delayTimer);
        var delayTimer = setTimeout(function() {
            $.each($('#chat-user').find('.user-chat'), function(ind, val){
                let dataName = $(val).data('name');
                
                if(!dataName.toLowerCase().includes(searchValue.toLowerCase())){
                    $(val).addClass('d-none');
                }else{
                    $(val).removeClass('d-none');
                }
            });
        }, 500);
    });
  
    $(document).on('submit', "#send-form", function (event) {
        event.preventDefault();
        var enctype = $(this).prop("enctype");
        if (!enctype) {
            enctype = "application/x-www-form-urlencoded";
        }

        $('#form-receiver-id').val($('.content-chat-message-user.active').data('id'));

        commonAjax($(this).prop('method'), $(this).prop('action'), window[$(this).data("handler")], window[$(this).data("handler")], new FormData($(this)[0]));
    });

        
    window.sendResponse = function (response) {
        if (response.status === true) {
            $(document).find('#send-form')[0].reset();
            $(document).find("#files-names").html('');
            dt.clearData(); 
            $(document).find("#mAttachment").trigger('change');
            toastr.success(response.message);
            loadMorePageCount = 0;
            loadSingleUserChat($('#single-user-chat-route').val(), loadMorePageCount, 0, 1);
        } else {
            if (response.status === 422) {
                var errors = response.responseJSON.errors;
                $(document).find('.error-message').remove();
                $.each(errors, function (index, items) {
                    toastr.error(items[0]);
                });
            } else {
                toastr.error(response.message);
            }
        }
    };

    window.isOnline = function(lastSeen) {
        // Parse the lastSeen timestamp into a Date object
        const lastSeenDate = new Date(lastSeen);
    
        // Get the current date and time
        const now = new Date();
    
        // Check if the lastSeen timestamp is greater than or equal to the current date and time
        return lastSeenDate >= now;
    }


    window.setUserUnseenMessage = function ($users) {
        $.each($('#chat-user').find('.user-chat'), function(ind, val){
            let userId = $(val).data('id');
            let selectedUser = $users.find(x => x.id == userId);
            if(selectedUser){
                let online = isOnline(selectedUser.last_seen);
                if(online){
                    $(document).find('.user-online-'+userId).removeClass('offline').addClass('online');
                    $(document).find('.user-online-text-'+userId).text($(document).find('.user-online-text-'+userId).data('online'));
                }else{
                    $(document).find('.user-online-'+userId).removeClass('online').addClass('offline');
                    $(document).find('.user-online-text-'+userId).text($(document).find('.user-online-text-'+userId).data('offline'));
                }

                if(selectedUser.unseen_message_count > 0){
                    $(document).find('.user-unseen-message-'+userId).removeClass('d-none');
                    $(document).find('.user-unseen-message-'+userId).html(selectedUser.unseen_message_count);
                }else{
                    $(document).find('.user-unseen-message-'+userId).addClass('d-none');
                }
                
            }
        });

        // single-unseen-message
    };

    window.loadSingleUserChat = function (url, page, prepend = true, reload) {
        postAjaxCalled = 1;
        let selector = $('.content-chat-message-user.active');
        let receiver_id = $(selector).data('id');
        $.ajax({
            type: "GET",
            url: url,
            data: {
                'receiver_id': receiver_id,
                'page': page,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            datatype: "json",
            success: function (res) {
                loadMorePageCount++;
                postAjaxCalled = 0;
                if (typeof prepend != 'undefined' && prepend == 1) {
                    $(selector).find('.body-chat-message-user').prepend(res.data.html);
                }else if (typeof reload != 'undefined' && reload == 1) {
                    $(selector).find('.body-chat-message-user').html(res.data.html);
                } else {
                    $(selector).find('.body-chat-message-user').append(res.data.html);
                }

                if(res.data.total_unseen_message){
                    $(document).find('#unseen-user-message').html(res.data.total_unseen_message);
                }else{
                    $(document).find('#unseen-user-message').html(res.data.total_unseen_message);
                }

                setUserUnseenMessage(res.data.unseen_user_message);

                $(document).find("#chat-body-"+receiver_id).scrollTop($(document).find("#chat-body-"+receiver_id)[0].scrollHeight);

                $(selector).find(".gallery").each(function () {
                    $(this).magnificPopup({
                        delegate: "a",
                        type: "image",
                        showCloseBtn: false,
                        preloader: false,
                        gallery: {
                            enabled: true,
                        },
                        callbacks: {
                            elementParse: function (item) {
                                if (item.el[0].className == "video") {
                                    item.type = "iframe";
                                } else {
                                    item.type = "image";
                                }
                            },
                        },
                    });
                });
            }
        });
    };

    window.loadMorePageCount = 1;
    window.postAjaxCalled = 0;
    
    window.addEventListener('load', function () {
        //load first chat
        loadSingleUserChat($('#single-user-chat-route').val(), loadMorePageCount, 0, 1);
    });

    if($('#pusherEnable').val() == 1){
        const pusherAppKey = $('#pusherKey').val();
        const pusherAppCluster = $('#pusherCluster').val();
        const pusher = new Pusher(pusherAppKey, {
            cluster: pusherAppCluster
        });

        const channel = pusher.subscribe('chat-channel');
        channel.bind('message', function (res) {
            loadSingleUserChat($('#single-user-chat-route').val(), loadMorePageCount, 0, 1);
        });
    }else{
        setInterval(function(){
            loadSingleUserChat($('#single-user-chat-route').val(), loadMorePageCount, 0, 1);
        }, 20000);    
    }

})(jQuery)


