$(function(){

    // Add new content blocks
    $('.addContent').on('click', function(e){

        e.preventDefault();

        var $container = $('#dynamic-content'),
            route = window.admin.dynamicblock,
            ajaxUrl = route.replace('DUMMYID', $('#selectContentType option:selected').val());

        $.get(ajaxUrl , function(data){

            var $html = $(data).hide();

            $container.append($html).find('.empty').remove();

            $html.fadeIn().find('[data-toggle=collapse]').trigger('click');

            $('html, body').animate({
                scrollTop: $html.offset().top
            }, 600);

            setPosition();
        });

    });

    // Remove content block
    $(document).on('click', '.removeContent', function(e){
        var $panel = $(this).closest('.panel');
        bootbox.confirm("Are you sure you want to remove this content?", function(result) {
            if(result){
                $panel.remove();
                setPosition();
            }
        });
    });

    // Move content blocks down
    $(document).on('click', ".moveDown", function (e) {
        var $parent = $(this).parents(".panel");

        if ($parent.is(':last-child')===false) {

            // Destroy CKEditor
            var cke = $parent.find('.ckeditor').attr('id');
            var editor = CKEDITOR.instances[cke];
            editor.destroy();

            // Move
            $parent.next().after($parent);

            // Rebuild
            CKEDITOR.replace(cke);
        }

        setPosition();
    });

    // Move content blocks up
    $(document).on('click', ".moveUp", function (e) {
        var $parent = $(this).parents(".panel");

        if ($parent.is(':first-child')===false) {

            // Destroy CKEditor
            var cke = $parent.find('.ckeditor').attr('id');
            var editor = CKEDITOR.instances[cke];
            editor.destroy();

            // Move
            $parent.prev().before($parent);

            // Rebuild
            CKEDITOR.replace(cke);
        }

        setPosition();
    });


    function setPosition() {
        $("#dynamic-content .position").each(function(i) {
            $(this).val(i);
        });
    }

    setPosition();

});
