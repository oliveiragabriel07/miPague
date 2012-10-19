/**
  * @name  Editable
  * @type  jQuery
  * @param String  options[tooltip]   optional tooltip text via title attribute **
  * @param String  options[event]     jQuery event such as 'click' of 'dblclick' **
  * @param String  options[highlight]    true or false, when true text is highlighted ??
  * @param Function option[callback] the function to be called when save button is clicked
  * @param Function option[save] the save button name
  * @param Function option[cancel] the cancel button name             
  */

(function($) {

    $.fn.editable = function(options) {
        var settings = $.extend({}, $.fn.editable.defaults, options);

        if ('destroy' === options) {
            return $(this).off(settings.event);
        }
                        
        return this.each(function() {
            var $this = $(this),
                el = this,
                view = $('.view', el),
                edit = $('.edit', el),
                $form, bbar, btnSave, btnCancel;
            
            function onEdit() {
                if ($this.editing) {
                    return;
                }
                
                $this.wrap('<form>');
                $form = $this.parent();
                $form.append(bbar);
                $this.editing = true;
                toggleState();  
            }
            
            function afterEdit(e, btn) {
                e.preventDefault();
                e.stopPropagation();
                
                if (settings.callback.call($this, btn) === false) {
                    return;
                }
                
                bbar.remove('', true);
                $this.unwrap();
                $this.editing = false;
                toggleState();                  
            }
            
            function toggleState() {
                view.toggle();
                edit.toggle();
            }

            /* show tooltip */
            if (settings.tooltip) {
                $(this).attr('title', settings.tooltip);
            }
            
            $(this).on(settings.event, function(e) {
                e.preventDefault();
                e.stopPropagation();
                onEdit();                
            });
            
            // create buttons
            bbar = $('<div class="editable-buttons-wrapper">');
            btnSave = $('<button type="submit">')
                .text(settings.save)
                .on('click.editable', function(e) {
                    afterEdit(e, 'save');
                });
            btnCancel = $('<button type="button">')
                .text(settings.cancel)
                .on('click.editable', function(e) {
                    afterEdit(e, 'cancel');
                });
                            
            bbar
                .append(btnSave)
                .append(btnCancel);
                
            edit.hide();
            view.show();
        });

    };

    // defaults
    $.fn.editable.defaults = {
        event      : 'click.editable',
        onblur     : 'cancel',
        callback: function() {},
        save : 'Salvar',
        cancel: 'Cancelar'
    };

}(jQuery));
