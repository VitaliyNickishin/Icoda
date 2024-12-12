(function() {
    tinymce.create('tinymce.plugins.mayak', {
        init : function(ed, url) {
            ed.addButton('yellow', {
                title : 'Желтый фон',
                image : url+'/ORIGINAL/images/ico-1.png',
                onclick : function() {
                    ed.selection.setContent('[yellow]' + ed.selection.getContent() + '[/yellow]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mayak', tinymce.plugins.mayak);
})();