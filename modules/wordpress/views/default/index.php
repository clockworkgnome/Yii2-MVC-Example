<?php
use yii\helpers\Url;
?>
<style>
<!--
.top5 { margin-top:5px; }
.top7 { margin-top:7px; }
.top10 { margin-top:10px; }
.top15 { margin-top:15px; }
.top17 { margin-top:17px; }
.top30 { margin-top:30px; }
-->
</style>
<div class="row">
<div class="col-lg-6">
	<div class="panel panel-default">
    		<div class="panel-heading">Does your site need some fresh graphics, stats or a new look?</div>
      	<div class="panel-body">
                <p> We can fix your broken, hacked, stale or out of date Wordpress website for you today. 
            	We only charge a standard flat fee for any Wordpress updates and fixes. We can also run 
            	monthly maintiance and updates for a low monthly fee. If you want a custom Wordpress theme 
            	we can do that too. We have flexable billing options at a petty cash budget.  </p>
			<div class="phone"> Call Us: 602-790-8610</div>
			<img src="<?= Url::base().'/img/buttons/contact.png' ?>" alt="Contact Us">
      	</div>
    </div>

	
</div>
<div class="col-lg-6">
        	<div class="panel panel-default">
    			<div class="panel-heading">Flexable Payment Options</div>
      			<div class="panel-body">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="F6HW3MZZNSM5E">
                            <input type="hidden" name="on0" value="plan">
                            <div class="well">
                            		<div class="row">
                            			<div class="col-lg-1 top15">
                                    		<input type="radio" name="os0" value ="option_0" checked="checked">
                                    </div>
                                    <div class="col-lg-11 top15">
                                        <strong>Pay the whole bill upfront</strong>
                                    </div>
                                    <div class="col-lg-11 top15">
                                        Amount at checkout $300.00 USD
                                    </div>
                                    <div class="col-lg-11 top15">
                                        *Use this option to pay your whole bill upfront
                                    </div>
                                </div>
                            </div>
                            
                            <div class="well">
                            		<div class="row">
                            			<div class="col-lg-1 top15">
                                			<input type="radio" name="os0" value ="option_1">
                                		</div>
                                		<div class="col-lg-11 top15">
                                			<strong>Pay half upfront then the rest when the project is finished</strong>
                                		</div>
                                	</div>
                                	<div class="row">
                                		<div class="col-lg-7 top15">
                                			Number of payments 2
                                		</div>
                                </div>
                                <div class="row">
                                		<div class="col-lg-2 top15">No. </div>
                                		<div class="col-lg-2 top15">Due* </div>
                                		<div class="col-lg-3 top15">Amount</div>
                                </div>
                                <div class="row">
                                		<div class="col-lg-2 top15">1</div>
                                		<div class="col-lg-2 top15">At checkout</div>
                                		<div class="col-lg-3 top15">$150.00 USD</div>
                                	</div>
                                	<div class="row">
                                		<div class="col-lg-2 top15">2</div>
                                		<div class="col-lg-2 top15">after 1 month</div>
                                		<div class="col-lg-3 top15">$150.00 USD</div>
                                	</div>
                                	<div class="row">
                                		<div class="col-lg-7 pull-right">Total   $300.00 USD</div>
                                </div>
                            </div>
                            <div class="well">
                            		<div class="row">
                            			<div class="col-lg-1 top15">
                                			<input type="radio" name="os0" value ="option_2">
                                		</div>
                                		<div class="col-lg-11 top15">
                                			<strong>Use this option if you would like continued service and updates each month</strong>
                                		</div>
                                	</div>
                                	<div class="row">
                                		<div class="col-lg-12 top15">
                                			Number of payments 4-Start payments At checkout
                                		</div>
                                	</div>
                                	<div class="row">
                                		<div class="col-lg-3 top15">
                    						Due* 
                    					</div>
                    					<div class="col-lg-3 top15">
                    						Amount
                    					</div>
                    				</div>
                    				<div class="row">
                        				<div class="col-lg-3 top15">
                                    		At checkout
                                    	</div>
                                    	<div class="col-lg-3 top15">
                                			$50.00 USD
                                		</div>
                                	</div>
                                	<div class="row">
                                		<div class="col-lg-3 top15">
                                			Every 1 month (x 3)
                                		</div>
                                		<div class="col-lg-3 top15">
                                			$50.00 USD
                                		</div>
                                	</div>
                                	<div class="row">
                                		<div class="col-lg-7 pull-right">
                                			Total   $200.00 USD
                                		</div>
                                </div>
                            </div>
                            	<div class="row">
                                		<div class="col-lg-12 top15">
                            				<i>* We calculate payments from the date of checkout.</i>
                            			</div>
                            	</div>
                            <input type="image" src="http://www.jujugaming.com/img/buttons/paynow.png" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                  	</div>
    			</div>
        </div>
    </div>