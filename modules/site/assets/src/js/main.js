/**
 * Created by roman on 01.05.15.
 */
$.fn.countdown = function(callback){
    this.each(function(){
        var self = this;
        var id = self.id;
        var time = localStorage.getItem(id);

        var countdown;

        if(!time || time < +new Date()){
            localStorage.setItem(id, +new Date() + $(self).data('time'));
            time = localStorage.getItem(id);
        }

        countdown = setInterval(function(){
            var current = +new Date();

            var left = parseInt((time - current) / 1000, 10);

            $(self).text(left + ' сек');

            if(left < 1){
                clearInterval(countdown);
                callback.apply(self);
            }
        }, 100);
    });
};

(function($){
    $(document).ready(function(){
        $('.countdown').countdown(function(){
            var button = $(this).closest('.btn');

            button.removeAttr('disabled');
            button.text(button.data('finish-text'));

            if(button.hasClass('autoclick')){
                button.trigger('click');
            }
        });



        $(document)
            .on('submit', '.form-ajax', function(event){
                event.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
            })

            .on('click', '.btn-countdown', function(event){
                if(this.disabled){
                    event.preventDefault();
                }
            })
        ;
    });
}(jQuery));