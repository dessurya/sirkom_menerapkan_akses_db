<div id="<?php echo $table_config['table_id']; ?>">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-title">
                <h3><?php echo $table_config['table_title']; ?></h3>
            </div>
            
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-info" onclick="return rebuildTableIndex(1)" title="refresh table">Refresh List</button>
                                <button class="btn btn-info" onclick="toogleClass('hide', '#<?php echo $table_config['table_id']; ?> thead input')" title="search">Search</button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon other-tools" data-toggle="dropdown" aria-expanded="true" title="tools"><span class="sr-only">Toggle Dropdown</span></button>
                                <div class="dropdown-menu other-tools" role="menu" style="">
                                    <?php foreach($table_config['tools'] as $list) { ?>
                                    <a class="dropdown-item action-item" onclick="return <?php echo $list['function']; ?>" href="#"><?php echo $list['label']; ?></a>
                                    <?php } ?>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" onclick="return selectAllRowTable('<?php echo $table_config['table_id']; ?>', true)"; class="dropdown-item selected-trigger">Selected All</a>
                                    <a href="#" onclick="return selectAllRowTable('<?php echo $table_config['table_id']; ?>', false)"; class="dropdown-item selected-trigger">Unselected All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-right">
                        <label class="tabel-info">Show <select name="show" onchange="return rebuildTableIndex(1)">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> entries || Order By <select name="order_key" onchange="return rebuildTableIndex(1)">
                            <?php
                            foreach($table_config['data_set'] as $list){
                            if($list['order'] == true){
                            ?>
                            <option <?php echo $table_config['data_order']['field'] == $list['field'] ? 'selected' : ''; ?> value="<?php echo $list['field']; ?>"><?php echo $list['label']; ?></option>
                            <?php }} ?>
                        </select> : <select name="order_val" onchange="return rebuildTableIndex(1)">
                            <option <?php echo $table_config['data_order']['value'] == 'asc' ? 'selected' : ''; ?> value="asc">ASC</option>
                            <option <?php echo $table_config['data_order']['value'] == 'desc' ? 'selected' : ''; ?> value="desc">DESC</option>
                        </select></label>
                    </div>
                </div>
            </li>
            <?php if(!empty($table_config['table_info'])){ ?>
            <li class="list-group-item"><?=$table_config['table_info'];?></li>
            <?php } ?>
        </ul>
        <div class="card-body table-responsive p-0" style="height: auto; max-height: 480px;">
            <table id="<?php echo $table_config['table_id']; ?>" class="table table-head-fixed text-nowrap selected-table">
                <thead>
                    <tr role="row">
                        <form>
                        <?php foreach($table_config['data_set'] as $list) { ?>
                        <th>
                            <?php 
                            echo $list['label']; 
                            if($list['search'] == true){
                            if($list['search_type'] == 'date'){
                            ?>
                            <input 
                                type="date" 
                                name="search_from_<?php echo $list['field']; ?>" 
                                class="form-control-sm hide" 
                                placeholder="From Date"
                                onchange="return rebuildTableIndex(1)">
                            <input 
                                type="date" 
                                name="search_to_<?php echo $list['field']; ?>" 
                                class="form-control-sm hide" 
                                placeholder="To Date"
                                onchange="return rebuildTableIndex(1)">
                            <?php } else if($list['search_type'] == 'text'){ ?>
                            <input 
                                type="text" 
                                name="search_<?php echo$list['field']; ?>" 
                                class="form-control-sm hide" 
                                placeholder="Search <?php echo $list['label']; ?>"
                                onchange="return rebuildTableIndex(1)">
                            <?php }} ?>
                        </th>
                        <?php } ?>
                        </form>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <span class="tabel-info">
                        Showing <strong id="from"></strong> to <strong id="to"></strong> of <strong id="total"></strong> entries
                    </span>
                </div>
                <div class="col tabel-info text-right">
                    <label>Pages <input type="number" name="page" onchange="return rebuildTableIndex(null)" min="1"> from <strong id="last_page"></strong></label>
                </div>
            </div>
        </div>
    </div>
</div>