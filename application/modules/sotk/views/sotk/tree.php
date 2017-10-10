<div class="row">
	<div class="col-md-12">
		<div id="message"></div>
		<div class="box box-success box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?= isset($head) ? $head : ''; ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<?php echo get_ol($satker); ?>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
		</div>
	</div>
</div>
<?php

function get_ol($array, $child = FALSE)
{
    $str = '';
	
    if(count($array)){
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';
        //$str .= $child == FALSE ? '<li id="item_">' :'';
        //$str .= $child == FALSE ? '<div>Beranda&nbsp&nbsp&nbsp&nbsp&nbsp<a class="btn btn-default btn-xs btn-flat" href="#"><i class="fa fa-info"></i></a>&nbsp<a class="btn btn-default btn-xs btn-flat" href="#" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a></div>' : '';
        //$str .= $child == FALSE ? '<hr>' : '';
        //$str .= $child == FALSE ? '</li>': '';
        foreach($array as $item){
            $str .= '<li id="item_'.$item['id'].'">';
            $str .= '<div>'. $item['satker'] .'</div>';
            
            if(isset($item['children']) && count($item['children'])){
                $str .= get_ol($item['children'], TRUE);
            }
            
            $str .= '</li>' . PHP_EOL;
        }
        
        $str .= '</ol>' . PHP_EOL;
    }else{
        $str = '<ol class="sortable">';
        $str .= $child == FALSE ? '<li id="item_">' :'';
        $str .= $child == FALSE ? '<div>Beranda&nbsp&nbsp&nbsp&nbsp&nbsp<a class="btn btn-default btn-sm" href="#"><i class="fa fa-info"></i></a>&nbsp<a class="btn btn-default btn-sm" href="#" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a></div>' : '';
        $str .= $child == FALSE ? '<hr>' : '';
        $str .= '</ol>';
    }
    
    return $str;
}

?>