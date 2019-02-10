<?php
/**
Template Name: Payment Summary
 */

if( ! isset( $_REQUEST['id'] ) || ! isset( $_REQUEST['id2'] ) || ! isset( $_REQUEST['id3'] ) || empty($_REQUEST['id']) || empty($_REQUEST['id2']) || empty($_REQUEST['id3']) ) {
    wp_die('Something went wrong. Please contact us to continue...');
}
if( !isset( $_SESSION ) )
    session_start();

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <title></title>

        <?php wp_head() ;?>
    </head>
    <body>
    <?php get_header( 'fibonatix' ); ?>
    <?php

    $invoice_order_id           = $_REQUEST['id'];
    $private_invoice_order_id   = $_REQUEST['id2'];
    $payment_id                 = $_REQUEST['id3'];
    require_once( INMANAGE_FIBONATIX_PATH . '/templates/php-libs/classes/fibonatix.class.php' );
    include_once( $_SERVER['DOCUMENT_ROOT'] .'/inmanage/class/system.php' );

    use Inmanage\SalesForce\SalesForceObject\SalesForceObject;
    use Inmanage\SalesForce\SalesForcePayment\SalesForcePayment;
    use Inmanage\SalesForce\SalesForceAccount\SalesForceAccount;
    use Inmanage\SalesForce\SalesForceQuery\SalesForceQuery;
    use Inmanage\SalesForce\SalesForceQueryResponse\SalesForceQueryResponse;

    if( $payment_id ) {
        $paymentObject = new SalesForcePayment( $payment_id );
        $account_id = $paymentObject->Account__c;
        $sf_account = new SalesForceAccount( $account_id );
        $wp_user_id = $sf_account->Website_User_ID__c;
    } else {
        wp_die('Something went wrong. Please contact us to continue..');
    }
    $product = 'book';

    //    $SalesForceObject = false;
    //    $payment_id = $_GET['payment_id'];
    //    $SalesForcePaymentObject = new SalesForcePayment( $payment_id );
    //    if( ! $SalesForcePaymentObject->Opportunity__c ) {
    //        $lead_id = $SalesForcePaymentObject->Lead__c;
    //        $SalesForceObject = SalesForceObject::lead_factory( $lead_id );
    //    } else if( $SalesForcePaymentObject->Account__c ) {
    //        $account_id = $SalesForcePaymentObject->Account__c;
    //        $SalesForceObject = new SalesForceAccount( $account_id );
    //    }
    //    ?>

    <div id="Main">
        <div id="MainDiv">
            <div id="MainDivCenter">

                <div id="TopProgressBar">
                    <div id="CurrentStep1" class="CurrentStep">
                        <div id="CurrentStep1Num">1.</div>
                        <div id="CurrentStep1NumDesc">Choose a Product</div>
                    </div>
                    <div id="CurrentStep2" class="CurrentStep">
                        <div id="CurrentStep2Num">2.</div>
                        <div id="CurrentStep2NumDesc">Select Payment Method</div>
                    </div>
                    <div id="CurrentStep3" class="CurrentStep">
                        <div id="CurrentStep3Num">3.</div>
                        <div id="CurrentStep3NumDesc">Payment Summery</div>
                    </div>
                </div>

                <div id="TopProgressBarMobile">
                    <div id="CurrentStep1Mobile">
                        1. Product
                    </div>

                    <div id="CurrentStep2Mobile">
                        2. Billing
                    </div>

                    <div id="CurrentStep3Mobile">
                        3. Summary
                    </div>
                </div>

                <div id="MainLeftDiv">

                    <div id="MainLeftTitleDiv">You're Almost there!</div>
                    <div id="PurchaseDetails">
                        <div id="PurchaseDetailsTitle">Login Details :</div>
                        <div id="PurchaseDetailsUsername">
                            <div id="PurchaseDetailsUsernameTitle">Username:</div>
                            <div id="PurchaseDetailsUsernameValue"><?php echo $sf_account->Website_Username__c; ?></div>
                        </div>

                        <div id="PurchaseDetailsPassword">
                            <div id="PurchaseDetailsPasswordTitle">Password:</div>
                            <div id="PurchaseDetailsPasswordValue"><?php echo $sf_account->Website_Password__c; ?></div>
                        </div>
                        <div>
                            <form action="<?php echo esc_url( admin_url('admin-post.php') ) ?>" method="post" id="loginForm">
                                <input type="hidden" name="username" value="<?php echo $sf_account->Website_Username__c; ?>" />
                                <input type="hidden" name="password" value="<?php echo $sf_account->Website_Password__c; ?>" />
                                <input type="hidden" name="action" value="login_user_action">
                                <?php echo wp_nonce_field( 'submit_login', '_wpnonce', true, false ) ?>
                                <input type="submit" value="Start your journey!" name="start_journey" id="start_journey" />
                            </form>

                        </div>
                        <div id="ebookLink">
                            <a href="#">Your eBook is here. Click me.</a>
                        </div>
                    </div>
                    <div id="MainLeftFormDiv">
                        <form id="addressForm">
                        <div id="FullName" class="DescAndInputDiv">
                            <div class="DescInputDiv">Full Name :</div>
                            <div class="InputDiv">
                                <input id="FullNameInput" name="FullName" class="NewInput" type="text" value="<?php echo $sf_account->FirstName; ?> <?php echo $sf_account->LastName; ?>"/>
                            </div>
                        </div>

                        <div id="AddressLine1" class="DescAndInputDiv">
                            <div class="DescInputDiv">Address Line 1 :</div>
                            <div class="InputDiv">
                                <input id="AddressLine1Input" name="AddressLine1" class="NewInput" type="text" />
                                <div class="InputDesc">Street address, P.O box, company name, c/o</div>
                                <div class="error" id="errorAddress1">This field is required</div>
                            </div>
                        </div>

                        <div id="AddressLine2" class="DescAndInputDiv">
                            <div class="DescInputDiv">Address Line 2 :</div>
                            <div class="InputDiv">
                                <input id="AddressLine2Input" name="AddressLine2" class="NewInput" type="text" />
                                <div class="InputDesc">Apartment, suite, unit, building, floor, etc.</div>
                            </div>
                        </div>

                        <div id="City" class="DescAndInputDiv">
                            <div class="DescInputDiv">City :</div>
                            <div class="InputDiv">
                                <input id="CityInput" name="City" class="NewInput" type="text" />
                                <div class="error" id="errorCity">This field is required</div>
                            </div>
                        </div>

                        <div id="ZipCode" class="DescAndInputDiv">
                            <div class="DescInputDiv">ZIP/Postal Code :</div>
                            <div class="InputDiv">
                                <input id="ZipCodeInput" name="ZipCode" class="NewInput" type="text" />
                                <div class="error" id="errorZipCode">This field is required</div>
                            </div>
                        </div>

                        <div id="Country" class="DescAndInputDiv">
                            <div class="DescInputDiv">Country :</div>
                            <div class="InputDiv">
                                <select id="CountryInput" class="NewSelect">
                                    <option value="AF">Afghanistan</option><option value="AX">Aland Islands</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia, Plurinational State of</option><option value="BQ">Bonaire, Sint Eustatius and Saba</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="TW">Chinese Taipei</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CD">Congo, the Democratic Republic of the</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote d'Ivoire</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option value="CW">Curaçao</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (Malvinas)</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and McDonald Islands</option><option value="VA">Holy See (Vatican City State)</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran, Islamic Republic of</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KP">Korea, Democratic People's Republic of</option><option value="KR">Korea, Republic of</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Lao People's Democratic Republic</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libyan Arab Jamahiriya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao</option><option value="MK">Macedonia, the former Yugoslav Republic of</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia, Federated States of</option><option value="MD">Moldova, Republic of</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="AN">Netherlands Antilles</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestinian Territory, Occupied</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">Rwanda</option><option value="BL">Saint Barthélemy</option><option value="SH">Saint Helena, Ascension and Tristan da Cunha</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="MF">Saint Martin (French part)</option><option value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome and Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SX">Sint Maarten (Dutch part)</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia and the South Sandwich Islands</option><option value="SS">South Sudan</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syrian Arab Republic</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania, United Republic of</option><option value="TH">Thailand</option><option value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States</option><option value="UM">United States Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VE">Venezuela, Bolivarian Republic of</option><option value="VN">Viet Nam</option><option value="VG">Virgin Islands, British</option><option value="WF">Wallis and Futuna</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option>
                                </select>
                            </div>
                        </div>

                        <div id="State" class="DescAndInputDiv">
                            <div class="DescInputDiv">State/Province/Region :</div>
                            <div class="InputDiv">
                                <select id="StateInput" class="NewInput"><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option></select>
                            </div>
                        </div>

                        <div id="Submit" class="DescAndInputDiv">
                            <div class="DescInputDiv"></div>
                            <div class="InputDiv">
                                <input type="hidden" name="ajax_url" value="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                                <input type="hidden" name="accountId" value="<?php echo $account_id; ?>">
                                <input type="hidden" name="paymentId" value="<?php echo $payment_id; ?>">
                                <input type="hidden" name="orderId" value="<?php echo $invoice_order_id; ?>">
                                <input type="hidden" name="orderPrivateId" value="<?php echo $private_invoice_order_id; ?>">
                                <div id="SubmitBtn">Submit</div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>

                <div id="MainRightDiv">
                    <div id="MainRightTopImgDiv"></div>
                    <div id="MainRightTopNameDiv">
                        <span id="NamePerson">Jan Coetzee</span>
                        <br/>
                        Software Engineer
                        <br/>
                        Cape Town, South Africa
                    </div>

                    <blockquote>
                        I'm young software engineer from South Africa now happily living and working in Vancouver.
                        <br/><br/>
                        I received my work permit under the Express Entry Visa - Young Professional category,
                        and was amazed at how many great companies wanted me to come work for them. My future
                        has never looked brighter!
                    </blockquote>

                    <div id="MainRightLikeDiv">
                        <div id="MainRightLikeLeftLineDiv"></div>
                        <div id="MainRightLikeImgDiv"></div>
                        <div id="MainRightLikeRightLineDiv"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    </body>

    </html>

<?php get_footer( 'fibonatix' ); ?>