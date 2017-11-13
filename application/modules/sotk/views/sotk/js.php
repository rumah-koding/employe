<script type='text/javascript'>//<![CDATA[
$(window).load(function () {
	var options = new primitives.orgdiagram.Config();	
	<?php if($struktur): ?>
	var items = [
		<?php foreach($struktur as $row): ?>
	  new primitives.orgdiagram.ItemConfig({
			id: '<?php echo $row->kode; ?>',
			parent: '<?php echo $row->kode == $this->uri->segment(3) ? 'null' : $row->parent_id ?>',
			title: "",
			description: "<?php echo $row->satker ?>",
			image: null,
	        templateName: "Template1"
		}),
		<?php endforeach; ?>
	];
	<?php else: ?>
	    var items = [];
	<?php endif; ?>

	options.items = items;
	options.cursorItem = 0;
	options.templates = [getTemplate()];
	options.onItemRender = onTemplateRender;
	options.hasSelectorCheckbox = primitives.common.Enabled.False;
	options.pageFitMode = primitives.common.PageFitMode.None;
	options.childrenPlacementType = primitives.common.ChildrenPlacementType.Horizontal;
	options.leavesPlacementType = primitives.common.ChildrenPlacementType.Vertical;
	options.normalItemsInterval= 10;
	options.normalLevelShift=10;
	options.dotLevelShift=10;
	options.lineLevelShift=10;
	options.graphicsType= primitives.common.GraphicsType.Canvas;
	options.scale= 1.0;
	options.navigationMode= primitives.common.NavigationMode.Inactive,
	jQuery("#basicdiagram").orgDiagram(options);

	function onTemplateRender(event, data) {
		switch (data.renderingMode) {
			case primitives.common.RenderingMode.Create:
				/* Initialize widgets here */
				break;
			case primitives.common.RenderingMode.Update:
				/* Update widgets here */
				break;
		}

		var itemConfig = data.context;

		if (data.templateName == "Template1") {
			data.element.find("[name=photo]").attr({ "src": itemConfig.image, "alt": itemConfig.title });
			data.element.find("[name=titleBackground]").css({ "background": itemConfig.itemTitleColor });

			var fields = ["title", "description", "phone", "email"];
			for (var index = 0; index < fields.length; index++) {
				var field = fields[index];

				var element = data.element.find("[name=" + field + "]");
				if (element.text() != itemConfig[field]) {
					element.text(itemConfig[field]);
				}
			}
		} 
	}

	function getTemplate() {
		var result = new primitives.orgdiagram.TemplateConfig();
		result.name = "Template1";

		result.itemSize = new primitives.common.Size(180, 80);
		result.minimizedItemSize = new primitives.common.Size(3, 3);
		result.highlightPadding = new primitives.common.Thickness(3, 3, 3, 3);


		var itemTemplate = jQuery(
		  '<div class="bp-item bp-corner-all bt-item-frame">'
			+ '<div name="description" class="bp-item" style="text-align:center; top: 15px; left: 0px; width: 180px; height: 50px; font-size: 11px;"></div>'
		+ '</div>'
		).css({
			width: result.itemSize.width + "px",
			height: result.itemSize.height + "px"
		}).addClass("bp-item bp-corner-all bt-item-frame");
		result.itemTemplate = itemTemplate.wrap('<div>').parent().html();
		return result;
	}
});//]]>
	  
</script>