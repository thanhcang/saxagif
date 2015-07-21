<div class="modal fade" id="viewSearchProductModal" tabindex="-1" role="dialog" aria-labelledby="viewCategoryModallLabel"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style=" height: 450px">
                <div class="box-content" style="height: 100%;  overflow: auto">
                    <form method="post" action="<?php echo base_url('ajax/processChooseProduct'); ?>" id="frmPopupSearchProduct">    
                        <table class="table responsive martopten datatable" id="pSearchProduct">
                            <colgroup>
                                <col width="5%"/>
                                <col width="5%"/>
                                <col width="45%"/>
                                <col width="45%"/>
                            </colgroup>   
                            <thead>
                                <tr>
                                    <th>stt</th>
                                    <th>Chọn</th>
                                    <th>Tên</th>
                                    <th>Mã code</th>
                                </tr>
                            </thead> 
                            <tbody>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" data-dismiss="modal" class="choseButton"><button type="button" class="button" id="okSearchProduct">Okie</button></a>
                <a href="javascript:;" data-dismiss="modal"><button type="button" class="button">Close</button></a>
            </div>

        </div>
    </div>
</div>

