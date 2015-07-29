/**
 * Created by roman on 01.05.15.
 */

(function($){
    $(document).on('ready', function(){
        $('.image-upload').imageUpload();

        function setIndex(wrapper){
            wrapper.children('.row').each(function(index, row){
                $(row).find('input').each(function(){
                    var id = $(this).attr('id').replace(/\d+/, index);
                    var name = $(this).attr('name').replace(/\d+/, index);

                    $(this).attr('id', id);
                    $(this).attr('name', name);
                });
            });
        }

        $(document)
            .on('click', '.btn-clone', function(){
                var btn = $(this);
                var template = btn.closest('.row').clone(true);
                var wrapper = btn.closest('.wrapper-for-clones-rows');

                template.find('.btn').addClass('btn-remove').removeClass('btn-clone').text('-');

                wrapper.append(template);

                setIndex(wrapper);
            })

            .on('click', '.btn-remove', function(){
                var btn = $(this);
                var wrapper = btn.closest('.wrapper-for-clones-rows');

                btn.closest('.row').remove();

                setIndex(wrapper);
            })
        ;
    });
}(jQuery));