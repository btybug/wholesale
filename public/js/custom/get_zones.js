window.postSendAjax = function(url, data, success, error) {
    $.ajax({
        type: "post",
        url: url,
        cache: false,
        datatype: "json",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        },
        success: function(data) {
            if (success) {
                success(data);
            }
            return data;
        },
        error: function(errorThrown) {
            if (error) {
                error(errorThrown);
            }
            return errorThrown;
        }
    });
};

// function makeSearchItem(basicData) {
//     if ($(basicData.inputValues).val()) {
//         console.log($(basicData.inputValues).val());
//         let arr = JSON.parse($(basicData.inputValues).val());
//         arr.forEach(item => {
//             $(basicData.containerForAppend).append(makeSearchHtml(item));
//         });
//     }
//     $(basicData.input).tagsinput({
//         maxTags: 5,
//         confirmKeys: [13, 32, 44],
//         freeInput: false,
//         typeaheadjs: {
//             displayKey: basicData.name,
//             valueKey: basicData.name,
//             source: function(query, processSync, processAsync) {
//                 let data2 = {};
//                 if (basicData.country) {
//                     data2 = { q: query, country: $("#country").val() };
//                 } else {
//                     data2 = { q: query };
//                 }
//                 return $.ajax({
//                     url: basicData.url,
//                     type: "POST",
//                     data: data2,
//                     dataType: "json",
//                     headers: {
//                         "X-CSRF-TOKEN": $("input[name='_token']").val()
//                     },
//                     success: function(json) {
//                         return processAsync(json);
//                     }
//                 });
//             },
//             templates: {
//                 empty: [
//                     '<div class="empty-message">',
//                     "No results",
//                     "</div>"
//                 ].join("\n"),
//                 header: `<h4>${basicData.title}</h4><hr>`,
//                 suggestion: function(data) {
//                     return `<div class="user-search-result"><span> ${
//                         data[basicData.name]
//                     } </span></div>`;
//                 }
//             }
//         }
//     });
//     $(basicData.input).on("beforeItemAdd", function(event) {
//         event.cancel = true;
//         let valueCatergorayName = $(basicData.inputValues).val();
//         if (!valueCatergorayName.includes(event.item)) {
//             $(basicData.containerForAppend).append(makeSearchHtml(event.item));
//             if (
//                 $(basicData.inputValues)
//                     .val()
//                     .trim()
//             ) {
//                 let arr = JSON.parse($(basicData.inputValues).val());
//                 arr.push(event.item);
//                 $(basicData.inputValues).val(JSON.stringify(arr));
//                 return;
//             }
//             let elm = [event.item];
//             $(basicData.inputValues).val(JSON.stringify(elm));
//             return;
//         }
//     });

//     function makeSearchHtml(data) {
//         return `<li><span class="remove-search-tag"><i class="fa fa-minus-circle"></i></span>${data}</li>`;
//     }
// }

$("body").on("input", "#region", function(e) {
    e.preventDefault();
    let country = $("#country").val();
    let val = $(this).val();
    $("#coupon-category").show();

    AjaxCall(
        "/admin/store/shipping-zones/find-region",
        { id: val, country: country },
        function(res) {
            if (!res.error) {
                $(".coupon-category-list").empty();
                // console.log(res);
                Object.values(res.data).forEach(item => {
                    if (item !== null) {
                        $(".coupon-category-list").append(
                            `<li class="region-item">${item}</li>`
                        );
                    }
                });
            }
        }
    );
});

$("body").on("click", ".region-item", function() {
    let value = $(this).text();
    $("#region").val(value);
    $(".coupon-category-list").empty();
    $("#coupon-category").hide();
});

$("body").on("click", ".remove-ship-filed", function() {
    $(this)
        .closest("tr")
        .remove();
});

$("body").on("click", ".delete-all-option", function(e) {
    console.log();
    let id = $(this).attr("data-table-id");
    $("body")
        .find(`[data-table-id="${id}"]`)
        .closest(".container-for-table-remove")
        .remove();
});

$("body").on("change", "#ShippingZones", function(e) {
    console.log(1111);
    e.preventDefault();
    let val = $(this).val();
    let text = $(this)
        .closest("tr")
        .find("#ShippingZones :selected")
        .text();
    let id = $(this)
        .closest("tr")
        .attr("data-table-id");

    let html2 = `
<table class="table table-responsive table--store-settings container-for-table-remove" data-table-id="${id}">
      <tr class="bg-my-light-blue">
      <td>Shipping Zone - <span class="shipzone">${val}</span></td>
      <td colspan="3">Tax Rate - <span class="taxzone">${text}</span></td>
      <td colspan="2" class="text-right"><button type="button" data-table-id="${id}" class="btn btn-primary delete-all-option"><i class="fa fa-trash"></i></button></span></td>
          </tr>
          <tbody>

          <tr class="bg-my-light-pink">
              <th>Order Amount</th>
              <th>Courier</th>
              <th>Cost</th>
              <th colspan="3">Time</th>
          </tr>
          <tr>
              <td class="table--store-settings_vert-top">
                  <input type="number" min="1" max="5" class="form-control" style="display: inline-block; width: auto">
                  <span>To</span>
                  <input type="number" min="1" max="50" class="form-control" style="display: inline-block; width: auto">
              </td>
              <td>
                  <select id="PosType" class="form-control">
                      <option selected>Normal Post</option>
                      <option>...</option>
                  </select>
              </td>
              <td>
                  <span class="form-control">
                      5
                  </span>
              </td>
              <td>
                  <span class="form-control">
                      3 days
                  </span>
              </td>
              <td colspan="2" class="text-right">
                  <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
              </td>
          </tr>
          <tr>
              <td></td>
              <td>
                  <select id="dhl" class="form-control">
                      <option selected>DHL</option>
                      <option>...</option>
                  </select>
              </td>
              <td>
                  <span class="form-control">
                      5
                  </span>
              </td>
              <td>
                  <span class="form-control">
                      1 day
                  </span>
              </td>
              <td colspan="2" class="text-right">
                  <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
              </td>
          </tr>
          <tr class="add-new-ship-filed-container">
              <td colspan="6" class="text-right">
                  <button type="button" class="btn btn-primary add-new-ship-filed"><i class="fa fa-plus-circle"></i></button>
              </td>
          </tr>
          </tbody>
          <tfoot>
          <tr>
              <td colspan="5" class="text-center table--store-settings_add-options add-new-order-filed">
                  <span><i class="fa fa-plus"></i></span> Add more option
              </td>
          </tr>
          </tfoot>
      </table>`;

    // console.log($(`table[data-table-id="${id}"]`))
    // $(`table[data-table-id="${id}"]`).find('.shipzone').text(text);
    // console.log($(`table[data-table-id="${id}"]`).find('.shipzone').text())
    // $(`table[data-table-id="${id}"]`).find('.taxzone').text(val);
    $("#myTabContent").append(html2);
});

// makeSearchItem({
//     input: "#payment_options",
//     name: "name",
//     url: "/admin/settings/store/shipping/search-payment-options",
//     title: "Payment Options",
//     inputValues: "#category-names",
//     containerForAppend: ".coupon-category-list"
// });

$("body").on("click", ".add-new-payment-option", function(e) {
    $(this).html(`<i class="fa fa-trash"></i>`);
    $(this).attr("class", "btn btn-danger ml-5 remove-new-payment-option");
    postSendAjax(
        "/admin/settings/store/shipping/search-payment-options",
        {},
        function(res) {
            let options = "";
            res.forEach(item => {
                options += `<option value="${item.key}">${item.key}</option>`;
            });
            let html = `<div class="payment-option-container mb-2" style="display: flex">
            <select class="form-control" id="payment_options" name="payment_options[]">
                ${options}
            </select>
            <button type="button" class="btn btn-primary add-new-payment-option ml-5"><i class="fa fa-plus"></i></button>
        
            </div>`;
            $(".payment-container").append(html);
        }
    );
});

$("body").on("click", ".remove-new-payment-option", function(e) {
    $(this)
        .closest(".payment-option-container")
        .remove();
});

// makeSearchItem({
//     input: "#region",
//     name: "name",
//     url: "/admin/settings/store/shipping/search-find-region",
//     title: "Regions Options",
//     inputValues: "#region-names",
//     containerForAppend: ".region-category-list",
//     country: true
// });
$("body").on("click", ".remove-search-tag", function() {
    let text = $(this)
        .closest("li")
        .text();

    let arr = JSON.parse(
        $(this)
            .closest(".wall")
            .find(".search-hidden-input")
            .val()
    );
    let index = arr.indexOf(text);
    arr.splice(index, 1);
    $(this)
        .closest(".wall")
        .find(".search-hidden-input")
        .val(JSON.stringify(arr));
    $(this)
        .closest("li")
        .remove();
});

$("body").on("change", `[name="delivery_cost_types_id"]`, function(e) {
    let value = $(this).val();
    let text = "";
    if (value === "1") {
        text = "Order Amount";
    } else if (value === "2") {
        text = "Weight Amount";
    }
    $("body")
        .find(".bg-my-light-pink")
        .each(function() {
            $(this)
                .children()
                .first()
                .text(text);
        });
});

$("body").on("change", ".country", function() {
    let value = $(this).val();
    let count = $(this).attr("data-count");
    let arr = [];
    $("body")
        .find(".country")
        .each(function(index, item) {
            let obj = {};
            obj["country"] = $("body").find(".country")[index].value;
            obj["region"] = $("body").find(".region")[index].value;
            arr.push(obj);
        });
    AjaxCall(
        "/admin/settings/store/shipping/search-find-region",
        { country: value, count, data: arr },
        res => {
            console.log(res);
            if (!res.error) {
                $(this)
                    .closest("tr")
                    .find(".region-container")
                    .empty()
                    .append(res.html);
                $(this)
                    .closest("tr")
                    .find(".region")
                    .select2();
            }
        }
    );
});

$("body").on("click", ".add-new-get-zones", function() {
    $(this).html(`<i class="fa fa-trash"></i>`);
    $(this).attr("class", "btn btn-danger remove-new-get-zones");
    let count = Number($(this).attr("data-count"));
    count++;
    let html = `<tr>
    <td>
       <select data-count="${count}" class="form-control country" name="country[${count}]">
          <option value="Aruba" selected="selected">Aruba</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Angola">Angola</option>
          <option value="Anguilla">Anguilla</option>
          <option value="Åland Islands">Åland Islands</option>
          <option value="Albania">Albania</option>
          <option value="Andorra">Andorra</option>
          <option value="United Arab Emirates">United Arab Emirates</option>
          <option value="Argentina">Argentina</option>
          <option value="Armenia">Armenia</option>
          <option value="American Samoa">American Samoa</option>
          <option value="Antarctica">Antarctica</option>
          <option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
          <option value="Antigua and Barbuda">Antigua and Barbuda</option>
          <option value="Australia">Australia</option>
          <option value="Austria">Austria</option>
          <option value="Azerbaijan">Azerbaijan</option>
          <option value="Burundi">Burundi</option>
          <option value="Belgium">Belgium</option>
          <option value="Benin">Benin</option>
          <option value="Burkina Faso">Burkina Faso</option>
          <option value="Bangladesh">Bangladesh</option>
          <option value="Bulgaria">Bulgaria</option>
          <option value="Bahrain">Bahrain</option>
          <option value="Bahamas">Bahamas</option>
          <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
          <option value="Saint Barthélemy">Saint Barthélemy</option>
          <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
          <option value="Belarus">Belarus</option>
          <option value="Belize">Belize</option>
          <option value="Bermuda">Bermuda</option>
          <option value="Bolivia">Bolivia</option>
          <option value="Caribbean Netherlands">Caribbean Netherlands</option>
          <option value="Brazil">Brazil</option>
          <option value="Barbados">Barbados</option>
          <option value="Brunei">Brunei</option>
          <option value="Bhutan">Bhutan</option>
          <option value="Bouvet Island">Bouvet Island</option>
          <option value="Botswana">Botswana</option>
          <option value="Central African Republic">Central African Republic</option>
          <option value="Canada">Canada</option>
          <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
          <option value="Switzerland">Switzerland</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Ivory Coast">Ivory Coast</option>
          <option value="Cameroon">Cameroon</option>
          <option value="DR Congo">DR Congo</option>
          <option value="Republic of the Congo">Republic of the Congo</option>
          <option value="Cook Islands">Cook Islands</option>
          <option value="Colombia">Colombia</option>
          <option value="Comoros">Comoros</option>
          <option value="Cape Verde">Cape Verde</option>
          <option value="Costa Rica">Costa Rica</option>
          <option value="Cuba">Cuba</option>
          <option value="Curaçao">Curaçao</option>
          <option value="Christmas Island">Christmas Island</option>
          <option value="Cayman Islands">Cayman Islands</option>
          <option value="Cyprus">Cyprus</option>
          <option value="Czechia">Czechia</option>
          <option value="Germany">Germany</option>
          <option value="Djibouti">Djibouti</option>
          <option value="Dominica">Dominica</option>
          <option value="Denmark">Denmark</option>
          <option value="Dominican Republic">Dominican Republic</option>
          <option value="Algeria">Algeria</option>
          <option value="Ecuador">Ecuador</option>
          <option value="Egypt">Egypt</option>
          <option value="Eritrea">Eritrea</option>
          <option value="Western Sahara">Western Sahara</option>
          <option value="Spain">Spain</option>
          <option value="Estonia">Estonia</option>
          <option value="Ethiopia">Ethiopia</option>
          <option value="Finland">Finland</option>
          <option value="Fiji">Fiji</option>
          <option value="Falkland Islands">Falkland Islands</option>
          <option value="France">France</option>
          <option value="Faroe Islands">Faroe Islands</option>
          <option value="Micronesia">Micronesia</option>
          <option value="Gabon">Gabon</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Georgia">Georgia</option>
          <option value="Guernsey">Guernsey</option>
          <option value="Ghana">Ghana</option>
          <option value="Gibraltar">Gibraltar</option>
          <option value="Guinea">Guinea</option>
          <option value="Guadeloupe">Guadeloupe</option>
          <option value="Gambia">Gambia</option>
          <option value="Guinea-Bissau">Guinea-Bissau</option>
          <option value="Equatorial Guinea">Equatorial Guinea</option>
          <option value="Greece">Greece</option>
          <option value="Grenada">Grenada</option>
          <option value="Greenland">Greenland</option>
          <option value="Guatemala">Guatemala</option>
          <option value="French Guiana">French Guiana</option>
          <option value="Guam">Guam</option>
          <option value="Guyana">Guyana</option>
          <option value="Hong Kong">Hong Kong</option>
          <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
          <option value="Honduras">Honduras</option>
          <option value="Croatia">Croatia</option>
          <option value="Haiti">Haiti</option>
          <option value="Hungary">Hungary</option>
          <option value="Indonesia">Indonesia</option>
          <option value="Isle of Man">Isle of Man</option>
          <option value="India">India</option>
          <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
          <option value="Ireland">Ireland</option>
          <option value="Iran">Iran</option>
          <option value="Iraq">Iraq</option>
          <option value="Iceland">Iceland</option>
          <option value="Israel">Israel</option>
          <option value="Italy">Italy</option>
          <option value="Jamaica">Jamaica</option>
          <option value="Jersey">Jersey</option>
          <option value="Jordan">Jordan</option>
          <option value="Japan">Japan</option>
          <option value="Kazakhstan">Kazakhstan</option>
          <option value="Kenya">Kenya</option>
          <option value="Kyrgyzstan">Kyrgyzstan</option>
          <option value="Cambodia">Cambodia</option>
          <option value="Kiribati">Kiribati</option>
          <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
          <option value="South Korea">South Korea</option>
          <option value="Kosovo">Kosovo</option>
          <option value="Kuwait">Kuwait</option>
          <option value="Laos">Laos</option>
          <option value="Lebanon">Lebanon</option>
          <option value="Liberia">Liberia</option>
          <option value="Libya">Libya</option>
          <option value="Saint Lucia">Saint Lucia</option>
          <option value="Liechtenstein">Liechtenstein</option>
          <option value="Sri Lanka">Sri Lanka</option>
          <option value="Lesotho">Lesotho</option>
          <option value="Lithuania">Lithuania</option>
          <option value="Luxembourg">Luxembourg</option>
          <option value="Latvia">Latvia</option>
          <option value="Macau">Macau</option>
          <option value="Saint Martin">Saint Martin</option>
          <option value="Morocco">Morocco</option>
          <option value="Monaco">Monaco</option>
          <option value="Moldova">Moldova</option>
          <option value="Madagascar">Madagascar</option>
          <option value="Maldives">Maldives</option>
          <option value="Mexico">Mexico</option>
          <option value="Marshall Islands">Marshall Islands</option>
          <option value="Macedonia">Macedonia</option>
          <option value="Mali">Mali</option>
          <option value="Malta">Malta</option>
          <option value="Myanmar">Myanmar</option>
          <option value="Montenegro">Montenegro</option>
          <option value="Mongolia">Mongolia</option>
          <option value="Northern Mariana Islands">Northern Mariana Islands</option>
          <option value="Mozambique">Mozambique</option>
          <option value="Mauritania">Mauritania</option>
          <option value="Montserrat">Montserrat</option>
          <option value="Martinique">Martinique</option>
          <option value="Mauritius">Mauritius</option>
          <option value="Malawi">Malawi</option>
          <option value="Malaysia">Malaysia</option>
          <option value="Mayotte">Mayotte</option>
          <option value="Namibia">Namibia</option>
          <option value="New Caledonia">New Caledonia</option>
          <option value="Niger">Niger</option>
          <option value="Norfolk Island">Norfolk Island</option>
          <option value="Nigeria">Nigeria</option>
          <option value="Nicaragua">Nicaragua</option>
          <option value="Niue">Niue</option>
          <option value="Netherlands">Netherlands</option>
          <option value="Norway">Norway</option>
          <option value="Nepal">Nepal</option>
          <option value="Nauru">Nauru</option>
          <option value="New Zealand">New Zealand</option>
          <option value="Oman">Oman</option>
          <option value="Pakistan">Pakistan</option>
          <option value="Panama">Panama</option>
          <option value="Pitcairn Islands">Pitcairn Islands</option>
          <option value="Peru">Peru</option>
          <option value="Philippines">Philippines</option>
          <option value="Palau">Palau</option>
          <option value="Papua New Guinea">Papua New Guinea</option>
          <option value="Poland">Poland</option>
          <option value="Puerto Rico">Puerto Rico</option>
          <option value="North Korea">North Korea</option>
          <option value="Portugal">Portugal</option>
          <option value="Paraguay">Paraguay</option>
          <option value="Palestine">Palestine</option>
          <option value="French Polynesia">French Polynesia</option>
          <option value="Qatar">Qatar</option>
          <option value="Réunion">Réunion</option>
          <option value="Romania">Romania</option>
          <option value="Russia">Russia</option>
          <option value="Rwanda">Rwanda</option>
          <option value="Saudi Arabia">Saudi Arabia</option>
          <option value="Sudan">Sudan</option>
          <option value="Senegal">Senegal</option>
          <option value="Singapore">Singapore</option>
          <option value="South Georgia">South Georgia</option>
          <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
          <option value="Solomon Islands">Solomon Islands</option>
          <option value="Sierra Leone">Sierra Leone</option>
          <option value="El Salvador">El Salvador</option>
          <option value="San Marino">San Marino</option>
          <option value="Somalia">Somalia</option>
          <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
          <option value="Serbia">Serbia</option>
          <option value="South Sudan">South Sudan</option>
          <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
          <option value="Suriname">Suriname</option>
          <option value="Slovakia">Slovakia</option>
          <option value="Slovenia">Slovenia</option>
          <option value="Sweden">Sweden</option>
          <option value="Swaziland">Swaziland</option>
          <option value="Sint Maarten">Sint Maarten</option>
          <option value="Seychelles">Seychelles</option>
          <option value="Syria">Syria</option>
          <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
          <option value="Chad">Chad</option>
          <option value="Togo">Togo</option>
          <option value="Thailand">Thailand</option>
          <option value="Tajikistan">Tajikistan</option>
          <option value="Tokelau">Tokelau</option>
          <option value="Turkmenistan">Turkmenistan</option>
          <option value="Timor-Leste">Timor-Leste</option>
          <option value="Tonga">Tonga</option>
          <option value="Trinidad and Tobago">Trinidad and Tobago</option>
          <option value="Tunisia">Tunisia</option>
          <option value="Turkey">Turkey</option>
          <option value="Tuvalu">Tuvalu</option>
          <option value="Taiwan">Taiwan</option>
          <option value="Tanzania">Tanzania</option>
          <option value="Uganda">Uganda</option>
          <option value="Ukraine">Ukraine</option>
          <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
          <option value="Uruguay">Uruguay</option>
          <option value="United States">United States</option>
          <option value="Uzbekistan">Uzbekistan</option>
          <option value="Vatican City">Vatican City</option>
          <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
          <option value="Venezuela">Venezuela</option>
          <option value="British Virgin Islands">British Virgin Islands</option>
          <option value="United States Virgin Islands">United States Virgin Islands</option>
          <option value="Vietnam">Vietnam</option>
          <option value="Vanuatu">Vanuatu</option>
          <option value="Wallis and Futuna">Wallis and Futuna</option>
          <option value="Samoa">Samoa</option>
          <option value="Yemen">Yemen</option>
          <option value="South Africa">South Africa</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabwe">Zimbabwe</option>
          <option value="Dhekelia">Dhekelia</option>
          <option value="Somaliland">Somaliland</option>
          <option value="USNB Guantanamo Bay">USNB Guantanamo Bay</option>
          <option value="N. Cyprus">N. Cyprus</option>
          <option value="Cyprus U.N. Buffer Zone">Cyprus U.N. Buffer Zone</option>
          <option value="Siachen Glacier">Siachen Glacier</option>
          <option value="Baikonur">Baikonur</option>
          <option value="Akrotiri">Akrotiri</option>
          <option value="Indian Ocean Ter.">Indian Ocean Ter.</option>
          <option value="Coral Sea Is.">Coral Sea Is.</option>
          <option value="Spratly Is.">Spratly Is.</option>
          <option value="Clipperton I.">Clipperton I.</option>
          <option value="Ashmore and Cartier Is.">Ashmore and Cartier Is.</option>
          <option value="Bajo Nuevo Bank">Bajo Nuevo Bank</option>
          <option value="Serranilla Bank">Serranilla Bank</option>
          <option value="Scarborough Reef">Scarborough Reef</option>
          <option value="Europe Union">Europe Union</option>
       </select>
    </td>
    <td>
       <div class="wall">
          <div class="region-container">
             <select class="form-control region" name="region[${count}]">
                <option value="Aruba" selected="selected">All Zones</option>
             </select>
          </div>
          <input id="region-names" class="search-hidden-input" name="regions" type="hidden">
       </div>
    </td>
    <td>
       <div>
          <button type="button" data-count="${count}" class="btn btn-primary add-new-get-zones"><i class="fa fa-plus"></i></button>
       </div>
    </td>
 </tr>`;
    $("#zone-to-geo-zone tfoot").append(html);
});

$("body").on("click", ".remove-new-get-zones", function() {
    $(this)
        .closest("tr")
        .remove();
});
