<div class="modal fade" id="viewSearchPartnerModal" tabindex="-1" role="dialog" aria-labelledby="viewPartnerModallLabel"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style=" height: 450px">
                <div class="box-content" style="height: 100%;  overflow: auto">
                    <form method="post" action="<?php echo base_url('ajax/processChoosePartner'); ?>" id="frmPopupSearchPartner">    
                        <table class="table responsive martopten datatable" id="pSearchPartner">
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
                                    <th>Ghi chú</th>
                                </tr>
                            </thead> 
                            <tbody>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" data-dismiss="modal" class="choseButton"><button type="button" class="button" id="okSearchPartner">Okie</button></a>
                <a href="javascript:;" data-dismiss="modal"><button type="button" class="button">Close</button></a>
            </div>

        </div>
    </div>
</div>



