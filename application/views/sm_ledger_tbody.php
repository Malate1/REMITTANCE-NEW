<?php foreach ($result as $row) {
                                $denom_id = $row->denom_id;
                                $total_satellite = $this->Model_Cashier_Sm->getTotalSatelliteByDenomId($denom_id);
                                if($this->session->userdata('bu') == 'XTRUCK' || $this->session->userdata('bu') == 'XTRUCK-NETMAN' || $this->session->userdata('bu') == 'XTRUCK-NETMAN-BPI' || $this->session->userdata('bu') == 'XTRUCK-MPDI'){
                                    $total_pal = $this->Model_Cashier_Sm->getTotalPalByDenomId($denom_id);
                                }else{
                                    $total_pal = $this->Model_Cashier_Sm->getTotalPalOpByDenomId($denom_id);
                                }
                                
                            ?>
                            <tr>
                                <td style="text-align: center">
                                    <?php if ($row->status == 'Pending' && $row->total_remittance != 0) : ?>
                                    <input style="text-align: center" class="form-check-input" type="checkbox"
                                        id="select-all-denom" name="selected_denom[]"
                                        value="<?php echo $row->denom_id; ?>">
                                    <input type="hidden" class="form-control"
                                        style="text-align: center; background-color: white" name="location"
                                        id="location" value="<?php echo $this->session->userdata('location'); ?>"
                                        readonly>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: center"><?php echo $row->denom_id; ?></td>
                                <td style="text-align: center"><?php echo @$row->manualsrr; ?></td>
                                <!-- <td><?php echo $row->full_name; ?></td> -->
                                <td><?php echo $row->id_no . ' - ' . $row->full_name; ?></td>

                                <td style="text-align: right"><?php echo number_format($row->total_cash, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format(@$total_pal->total_pal, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_dc, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_pdc, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_collection, 2); ?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($row->total_collection + @$total_pal->total_pal, 2); ?></td>
                                <td style="text-align: right">
                                    <?php echo number_format($row->total_remittance + @$total_pal->total_pal, 2); ?></td>
                                <td style="text-align: right">
                                    <?php echo number_format(@$total_satellite->total_satellite, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_srr, 2); ?></td>
                                <?php if ($this->session->userdata('location') == 'LDI' || $this->session->userdata('location') == 'LDI-CDC' || $this->session->userdata('location') == 'LDI-UDC') { ?>
                                <td style="text-align: right"><?php echo number_format($row->total_returns, 2); ?></td>
                                <?php if ($this->session->userdata('bu') == 'XTRUCK' || $this->session->userdata('bu') == 'XTRUCK-NETMAN' || $this->session->userdata('bu') == 'XTRUCK-NETMAN-BPI' || $this->session->userdata('bu') == 'XTRUCK-MPDI') { ?>
                                <td style="text-align: right"><?php echo number_format($row->wtax, 2); ?></td>
                                <?php } else { ?>
                                <td style="text-align: right"><?php echo number_format($row->vat, 2); ?></td>
                                <?php } ?>
                                <td style="text-align: right"><?php echo number_format($row->bo, 2); ?></td>
                                <?php } ?>
                                <?php if ($this->session->userdata('bu') == 'XTRUCK' || $this->session->userdata('bu') == 'XTRUCK-NETMAN' || $this->session->userdata('bu') == 'XTRUCK-NETMAN-BPI' || $this->session->userdata('bu') == 'XTRUCK-MPDI') { ?>
                                <td style="text-align: right"><?php echo number_format($row->sm_inc, 2); ?></td>
                                <?php } ?>
                                <?php
                                    $total_amount = $row->total_collection + @$total_pal->total_pal + $row->sm_inc;
                                    $rem_amt = $total_amount - ($row->total_remittance + @$total_pal->total_pal);

                                    if (floatval($row->total_remittance + @$total_pal->total_pal) < $total_amount) {
                                        $rem = 'Over (' . number_format($rem_amt, 2) . ')';
                                    } elseif (floatval($row->total_remittance + @$total_pal->total_pal) > $total_amount) {
                                        $rem = 'Short (' . number_format($rem_amt, 2) . ')';
                                    } else {
                                        $rem = 'None';
                                    }
                                    ?>
                                <td style="text-align: right"><?php echo $rem; ?></td>
                                <td style="text-align: center"><?php if ($row->status == "Pending") {
                                    echo "<span class='badge badge-danger'>" . $row->status . "</span>";
                                } else {
                                    echo "<span class='badge badge-primary'>" . $row->status . "</span>";
                                } ?></td>
                                <td align="center">
                                    <?php if ($row->date_added == date('Y-m-d')) { ?>
                                    <a title="View Denomination2" style="color: black;cursor: pointer"
                                        data-toggle="modal" data-target="#viewSmDenomLdi"
                                        onclick="viewsmdenom_content_ldi('<?php echo $row->denom_id; ?>')"><i
                                            class="fas fa-dollar-sign fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php if ($row->status == 'Pending') { ?>
                                    <?php 
                                        $manualsrr_empty = empty(trim($row->manualsrr));
                                        $manualsrr_required_for = ["XTRUCK", "XTRUCK-NETMAN", "XTRUCK-MPDI", "XTRUCK-NETMAN-BPI"];
                                        $requires_manualsrr = in_array($row->bu, $manualsrr_required_for);
                                        if (
                                            
                                            ($row->dc_pcs != '0' && $row->cashier_dcpcs == '0' && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI') ||
                                            ($row->pdc_pcs != '0' && $row->cashier_pdcpcs == '0' && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI') ||
                                            ($row->dc_pcs != $row->cashier_dcpcs && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI')  ||
                                            ($row->pdc_pcs != $row->cashier_pdcpcs && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI') ||
                                            ($row->total_dc != $row->cashier_dc && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI')  ||
                                            ($row->total_pdc != $row->cashier_pdc && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI') 
                                        ) { ?>
                                        <a title="Approve21" class="disabled-link"
                                            style="color: #4967B4;cursor: not-allowed;"><i
                                                class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                        <?php } else if (
                                            
                                                ($requires_manualsrr && $manualsrr_empty) 
                                                
                                            ) { ?>
                                        <a title="Approve22" class="disabled-link"
                                            style="color: #4967B4;cursor: not-allowed;"><i
                                                class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                        <?php }  else { ?>
                                        <a title="Approve23" class="enabled-link" style="color: #4967B4;cursor: pointer;"
                                            onclick="approve_sm_denomldi('<?php echo $row->denom_id; ?>')"><i
                                                class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>


                                    <?php if (($row->dc_pcs != '0' && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI') || ($row->pdc_pcs != '0' && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI')) { ?>
                                    <a title="Check Entry" style="color: green;cursor: pointer"
                                        href="<?= base_url('/checkentry'); ?>/<?php echo $row->denom_id; ?>/<?php echo $row->date_added; ?>/<?php echo $row->user_id; ?>"><i
                                            class="fas fa-pen-alt fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php } else { ?>
                                    <a title="Disapprove" style="color: red;cursor: pointer"
                                        onclick="disapprove_sm_denom('<?php echo $row->denom_id; ?>')"><i
                                            class="far fa-thumbs-down fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php } else { ?>
                                    <a title="View Denomination2" style="color: black;cursor: pointer"
                                        data-toggle="modal" data-target="#viewSmDenomLdi"
                                        onclick="viewsmdenom_content_ldi('<?php echo $row->denom_id; ?>')"><i
                                            class="fas fa-dollar-sign fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php if ($row->status == 'Pending') { ?>
                                    <?php 
                                        $manualsrr_empty = empty(trim($row->manualsrr));
                                        $manualsrr_required_for = ["XTRUCK", "XTRUCK-NETMAN", "XTRUCK-MPDI", "XTRUCK-NETMAN-BPI"];
                                        $requires_manualsrr = in_array($row->bu, $manualsrr_required_for);
                                            if (
                                                    ($row->dc_pcs != '0' && $row->cashier_dcpcs == '0' && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI') ||
                                                    ($row->pdc_pcs != '0' && $row->cashier_pdcpcs == '0' && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI') ||
                                                    ($row->dc_pcs != $row->cashier_dcpcs && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI')  ||
                                                    ($row->pdc_pcs != $row->cashier_pdcpcs && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI') ||
                                                    ($row->total_dc != $row->cashier_dc && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI')  ||
                                                    ($row->total_pdc != $row->cashier_pdc && $row->bu != 'OPLAN' && $row->bu != 'XTRUCK' && $row->bu != 'XTRUCK-NETMAN' && $row->bu != 'XTRUCK-MPDI' && $row->bu != 'XTRUCK-NETMAN-BPI')
                                                ) { ?>
                                    <a title="Approve21" class="disabled-link"
                                        style="color: #4967B4;cursor: not-allowed;"><i
                                            class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } else if (
                                            
                                            ($requires_manualsrr && $manualsrr_empty) 
                                            
                                        ) { ?>
                                    <a title="Approve223" class="disabled-link"
                                        style="color: #4967B4;cursor: not-allowed;"><i
                                            class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                    
                                    <?php } else { ?>
                                    <a title="Approve2" class="enabled-link" style="color: #4967B4;cursor: pointer;"
                                        onclick="approve_sm_denomldi('<?php echo $row->denom_id; ?>')"><i
                                            class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php if ($row->bu == 'OPLAN') { ?>
                                    <a title="View Checks" style="color: orange;cursor: pointer"
                                        href="<?= base_url('/viewsmchecks'); ?>/<?php echo $row->user_id; ?>/<?php echo $row->date_added; ?>/<?php echo $row->denom_id; ?>"><i
                                            class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php if ($row->bu == 'XTRUCK' || $row->bu == 'XTRUCK-NETMAN' || $row->bu == 'XTRUCK-MPDI' || $row->bu == 'XTRUCK-NETMAN-BPI') { ?>
                                        <a title="View Checks" style="color: orange;cursor: pointer"
                                            data-toggle="modal" data-target="#viewSmChecksLdi"
                                            onclick="viewsmchecks_content_ldi('<?php echo $row->user_id; ?>,<?php echo $row->date_added; ?>,<?php echo $row->denom_id; ?>')">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>&nbsp;&nbsp;

                                        <a title="View Palawan" style="color: #17a2b8;cursor: pointer"
                                            data-toggle="modal" data-target="#viewSmPalLdi"
                                            onclick="viewsmpal_content_ldi('<?php echo $row->user_id; ?>,<?php echo $row->date_added; ?>,<?php echo $row->denom_id; ?>')">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <a title="Remarks" style="color: #A074C4;cursor: pointer" data-toggle="modal"
                                        data-target="#cashierRemarks"
                                        onclick="cashier_remarks('<?php echo $row->denom_id; ?>')"><?php if ($row->remarks == "") {
                                            echo '<i class="far fa-comment fa-lg"></i>';
                                        } else {
                                            echo '<i class="fas fa-comment"></i>';
                                        } ?></a>&nbsp;&nbsp;
                                    <?php if ($row->status == 'Approved') { ?>
                                    <a title="Print2" style="color: #17a2b8;cursor: pointer"
                                        onclick="print_denomldi('<?php echo $row->denom_id; ?>')"><i
                                            class="fas fa-print fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php if ($row->bu == 'OPLAN') { ?>
                                    <!-- <a title="Upload" style="color: orange;cursor: pointer"
                                        onclick="upload_payments('<?php echo $row->denom_id; ?>')"><i
                                            class="fas fa-upload fa-lg"></i></a> -->

                                            <?php
                                                $manualsrr = $row->manualsrr;

                                                // Check if manualsrr is a non-empty, numeric value
                                                $isValidManualsrr = !empty($manualsrr) && preg_match('/^\d+$/', $manualsrr);

                                                if ($isValidManualsrr) { ?>

                                                    <!-- <a title="Upload2" style="color: orange; cursor: pointer"
                                                    onclick="upload_payments('<?php echo $row->denom_id; ?>')">
                                                        <i class="fas fa-upload fa-lg"></i>
                                                    </a>&nbsp;&nbsp; -->

                                                    <?php if ($row->status3 == '' && $row->status4 == '') { ?>
                                                        <a title="Upload2" style="color: orange;cursor: pointer"
                                                            onclick=upload_payments('<?php echo $row->denom_id; ?>')><i
                                                                class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;
                                                        <?php } else { ?>
                                                            <a title="Upload2" style="color: #17a2b8;cursor: pointer"
                                                            onclick=upload_payments('<?php echo $row->denom_id; ?>')><i
                                                                class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <a title="Upload Disabled" style="color: gray; cursor: not-allowed" onclick="return false;">
                                                        <i class="fas fa-upload fa-lg"></i>
                                                    </a>&nbsp;&nbsp;
                                                <?php } ?>
                                    <?php } ?>
                                    <?php if ($row->bu == 'XTRUCK' || $row->bu == 'XTRUCK-NETMAN' || $row->bu == 'XTRUCK-MPDI' || $row->bu == 'XTRUCK-NETMAN-BPI') { ?>
                                    <a title="Upload4" style="color: green;cursor: pointer"
                                        onclick="download_payments_xtruck('<?php echo $row->denom_id; ?>')"><i
                                            class="fas fa-download fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php if($this->session->userdata('location')!='LDI-UDC') { ?>

                                        <?php if ($row->status3 == '' && $row->status4 == '') { ?>
                                            <a title="Upload2" style="color: orange;cursor: pointer"
                                                onclick=upload_payments_xtruck('<?php echo $row->denom_id; ?>')><i
                                                    class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;
                                            <?php } else { ?>
                                                <a title="Upload2" style="color: #17a2b8;cursor: pointer"
                                                onclick=upload_payments_xtruck('<?php echo $row->denom_id; ?>')><i
                                                    class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;
                                        <?php } ?>
                                                
                                            
                                    <?php } else { ?>

                                        <?php if ($row->status3 == '' && $row->status4 == '') { ?>
                                            <a title="Upload3" style="color: orange;cursor: pointer"
                                                onclick=upload_payments_xtruck_udc('<?php echo $row->denom_id; ?>')><i
                                                    class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;
                                            <?php } else { ?>
                                                <a title="Upload3" style="color: #17a2b8;cursor: pointer"
                                                onclick=upload_payments_xtruck_udc('<?php echo $row->denom_id; ?>')><i
                                                    class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;
                                        <?php } ?>
                                   
                                    <?php } ?>
                                    <?php } ?>

                                    <?php if($row->bu == 'MPDI') { ?>

                                    <a title="Upload4" style="color: green;cursor: pointer"
                                        onclick=download_payments_mpdi('<?php echo $row->denom_id; ?>')><i
                                            class="fas fa-download fa-lg"></i></a>&nbsp;&nbsp;

                                    <?php } ?>

                                    <?php if($row->user_id == '325') { ?>

                                        <a title="Upload5" style="color: orange;cursor: pointer"
                                        onclick=upload_payments_xtruck_big('<?php echo $row->denom_id; ?>')><i
                                            class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;

                                    <?php } ?>

                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>