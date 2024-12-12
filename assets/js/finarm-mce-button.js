(function() {
	tinymce.PluginManager.add('wdm_mce_dropbutton', function( editor, url ) {
		editor.addButton( 'wdm_mce_dropbutton', {
			text: 'Font Weight',
			icon: false,
			type: 'menubutton',
			menu: [
				{
					text: '300',
					onclick: function() {
						// editor.selection.setContent('<span style="font-weight:300;">' + editor.selection.getContent() + '</span>');
						// console.log(editor.selection.parent());

						// console.log(editor.selection.getNode());
						// var 
						// console.log(editor.dom.getParent())
						// 

						changeWeight(editor, '300');

						// var content_editor = jQuery(editor.getBody()).text();

						// var content_selection = editor.selection.getContent({format : 'text'});
						// console.log(content_selection);
						// console.log(content_editor);

					}
				},
				{
					text: '400',
					onclick: function() {
						changeWeight(editor, '400');
					}
				},
				{
					text: '500',
					onclick: function() {
						changeWeight(editor, '500');
					}
				},
				{
					text: '600',
					onclick: function() {
						changeWeight(editor, '600');
					}
				},
				{
					text: '700',
					onclick: function() {
						changeWeight(editor, '700');
					}
				},
				{
					text: '800',
					onclick: function() {
						changeWeight(editor, '800');
					}
				},
			]
		});
	});

	function changeWeight(editor, $size) {

		var getNode = editor.selection.getNode();
		var getParent = editor.dom.getParent(getNode, 'span');

		if ( getParent != null ) {
			jQuery(getParent).attr('style', 'font-weight:'+$size+';' );
			jQuery(getParent).attr({
				'style': 'font-weight:'+$size+';',
				'data-mce-style': 'font-weight:'+$size+';'
			});
		} else {
			editor.selection.setContent('<span style="font-weight:'+ $size +';">' + editor.selection.getContent() + '</span>');
		}
	}
})();