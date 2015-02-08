//Big buttons
(function() {
    tinymce.create('tinymce.plugins.mm_bigbutton', {
        init : function(ed, url) {
            ed.addButton('mm_bigbutton', {
                title : 'Big button',
                image : url+'/img/1.png',
                onclick : function() {
                     ed.selection.setContent('[bigbutton url="" color=""]' + ed.selection.getContent() + '[/bigbutton]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mm_bigbutton', tinymce.plugins.mm_bigbutton);
})();
//Small buttons
(function() {
    tinymce.create('tinymce.plugins.mm_smallbutton', {
        init : function(ed, url) {
            ed.addButton('mm_smallbutton', {
                title : 'Small button',
                image : url+'/img/2.png',
                onclick : function() {
                     ed.selection.setContent('[smallbutton url="" color=""]' + ed.selection.getContent() + '[/smallbutton]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mm_smallbutton', tinymce.plugins.mm_smallbutton);
})();
//Ico buttons
(function() {
    tinymce.create('tinymce.plugins.mm_icobutton', {
        init : function(ed, url) {
            ed.addButton('mm_icobutton', {
                title : 'Ico button',
                image : url+'/img/3.png',
                onclick : function() {
                     ed.selection.setContent('[icobutton url="" ico=""]' + ed.selection.getContent() + '[/icobutton]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mm_icobutton', tinymce.plugins.mm_icobutton);
})();
//
(function() {
    tinymce.create('tinymce.plugins.mm_smallbox_third', {
        init : function(ed, url) {
            ed.addButton('mm_smallbox_third', {
                title : 'Small third box',
                image : url+'/img/6.png',
                onclick : function() {
                     ed.selection.setContent('[smallbox_third color=""]' + ed.selection.getContent() + '[/smallbox_third]');
               }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mm_smallbox_third', tinymce.plugins.mm_smallbox_third);
})();
//
(function() {
    tinymce.create('tinymce.plugins.mm_smallbox_half', {
        init : function(ed, url) {
            ed.addButton('mm_smallbox_half', {
                title : 'Small half box',
                image : url+'/img/5.png',
                onclick : function() {
                     ed.selection.setContent('[smallbox_half color=""]' + ed.selection.getContent() + '[/smallbox_half]');
               }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mm_smallbox_half', tinymce.plugins.mm_smallbox_half);
})();
//
(function() {
    tinymce.create('tinymce.plugins.mm_smallbox_full', {
        init : function(ed, url) {
            ed.addButton('mm_smallbox_full', {
                title : 'Small full box',
                image : url+'/img/4.png',
                onclick : function() {
                     ed.selection.setContent('[smallbox_full color=""]' + ed.selection.getContent() + '[/smallbox_full]');
               }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mm_smallbox_full', tinymce.plugins.mm_smallbox_full);
})();

