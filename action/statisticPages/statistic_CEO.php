<main>
    <div class="container" id="ceoStat_btnDiv">
        <div class="dropdown">
            <button onclick="showFunction1()" id="dropDownbtn1" class="button-77" value="off">Respondent-wise</button>

            <div id="respWiseDropdown" class="dropdown-content">
                <input type="text" placeholder="Search.." id="respWiseInput" onkeyup="filterFunction()">
            </div>
        </div>
        <br>
        <div class="dropdown">
            <button onclick="showFunction2()" id="dropDownbtn2" class="button-77" value="off">Client-wise</button>

            <div id="clntWiseDropdown" class="dropdown-content">
                <input type="text" placeholder="Search.." id="clntWiseInput" onkeyup="filterFunction1()">
            </div>
        </div>
    </div>
    <div id="lblDivsion">
        <label id="respiplbl" style="display: none;"></label>
        <label id="clntiplbl" style="display: none;"></label>
    </div>

    <div class="align-items-center justify-content-center" style="display: none;" id="respWiseFilterdiv">
        <h2 class="statheading">Client Statistics</h2>
        <h3 class="statheading" id="tblHd_resp">Respondent Wise</h3>

        <div class="row justify-content-center">
            <div class="col-sm-2">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body">Post Calling Recommendation (PCR) & Assesment- Response</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div id="ceoR_dd_container1">
                            <ul id="ceoR_dd_ul1">
                                <li id="ceoR_dropdown1" tab-index="0">
                                    <img src="/image/crm_icon/dropdown.png" alt="dropdown" class="rounded-circel" width="20px" height="20px">
                                    <ul id="ceoR_sub-dropdown1">
                                        <li><a href="#" data-value="pcr_resp|90,100|ceo_R">Very Good</a></li>
                                        <li><a href="#" data-value="pcr_resp|70,89|ceo_R">Good</a></li>
                                        <li><a href="#" data-value="pcr_resp|50,69|ceo_R">Average</a></li>
                                        <li><a href="#" data-value="pcr_resp|49,10|ceo_R">Poor</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body">Post Calling Recommendation (PCR) & Assesment- Projected Target(PT)</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div id="ceoR_dd_container2">
                            <ul id="ceoR_dd_ul2">
                                <li id="ceoR_dropdown2" tab-index="0">
                                    <img src="/image/crm_icon/dropdown.png" alt="dropdown" class="rounded-circel" width="20px" height="20px">
                                    <ul id="ceoR_sub-dropdown2">
                                        <li><a href="#" data-value="pcr_pt|1,15|ceo_R">Immediate</a></li>
                                        <li><a href="#" data-value="pcr_pt|16,30|ceo_R">Fast</a></li>
                                        <li><a href="#" data-value="pcr_pt|31,45|ceo_R">Moderate</a></li>
                                        <li><a href="#" data-value="pcr_pt|46,...|ceo_R">Slow</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2" id="pcr_prcID">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body">Post Calling Recommendation (PCR) & Assesment- Probability Rate of Conversion(PRC)</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div id="ceoR_dd_container3">
                            <ul id="ceoR_dd_ul3">
                                <li id="ceoR_dropdown3" tab-index="0">
                                    <img src="/image/crm_icon/dropdown.png" alt="dropdown" class="rounded-circel" width="20px" height="20px">
                                    <ul id="ceoR_sub-dropdown3">
                                        <li><a href="#" data-value="pcr_prc|1,15|ceo_R">High</a></li>
                                        <li><a href="#" data-value="pcr_prc|16,30|ceo_R">Moderate</a></li>
                                        <li><a href="#" data-value="pcr_prc|31,45|ceo_R">Average</a></li>
                                        <li><a href="#" data-value="pcr_prc|46,...|ceo_R">Low</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body">Post Calling Recommendation (PCR) & Assesment- Client's Classification /Ratings</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div id="ceoR_dd_container4">
                            <ul id="ceoR_dd_ul4">
                                <li id="ceoR_dropdown4" tab-index="0">
                                    <img src="/image/crm_icon/dropdown.png" alt="dropdown" class="rounded-circel" width="20px" height="20px">
                                    <ul id="ceoR_sub-dropdown4">
                                        <li><a href="#" data-value="pcr_client_rating|A++|ceo_R">Good</a></li>
                                        <li><a href="#" data-value="pcr_client_rating|A+|ceo_R">Fair</a></li>
                                        <li><a href="#" data-value="pcr_client_rating|A|ceo_R">Average</a></li>
                                        <li><a href="#" data-value="pcr_client_rating|B|ceo_R">Poor</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body">Client Status(Based upon your last entry for the particular client)</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div id="ceoR_dd_container5">
                            <ul id="ceoR_dd_ul5">
                                <li id="ceoR_dropdown5" tab-index="0">
                                    <img src="/image/crm_icon/dropdown.png" alt="dropdown" class="rounded-circel" width="20px" height="20px">
                                    <ul id="ceoR_sub-dropdown5">
                                        <li><a href="#" data-value="client_stat|Did Not Receive|ceo_R">Did Not Receive</a></li>
                                        <li><a href="#" data-value="client_stat|Not Reachable|ceo_R">Not Reachable</a></li>
                                        <li><a href="#" data-value="client_stat|Not From This Field|ceo_R">Not From This Field</a></li>
                                        <li><a href="#" data-value="client_stat|Declined The Call|ceo_R">Declined The Call</a></li>
                                        <li><a href="#" data-value="client_stat|Not Responding|ceo_R">Not Responding</a></li>
                                        <li><a href="#" data-value="client_stat|Number Invalid|ceo_R">Number Invalid</a></li>
                                        <li><a href="#" data-value="client_stat|Not Interested|ceo_R">Not Interested</a></li>
                                        <li><a href="#" data-value="client_stat|Having Grievances|ceo_R">Having Grievances</a></li>
                                        <li><a href="#" data-value="client_stat|Follow Up Later|ceo_R">Follow Up Later</a></li>
                                        <li><a href="#" data-value="client_stat|Negative Client|ceo_R">Negative Client</a></li>
                                        <li><a href="#" data-value="client_stat|NI-Post Profile Sharing|ceo_R">NI-Post Profile Sharing</a></li>
                                        <li><a href="#" data-value="client_stat|Left The Field/Trade|ceo_R">Left The Field/Trade</a></li>
                                        <li><a href="#" data-value="client_stat|No Current Proposal|ceo_R">No Current Proposal</a></li>
                                        <li><a href="#" data-value="client_stat|Shared Profile|ceo_R">Shared Profile</a></li>
                                        <li><a href="#" data-value="client_stat|Client|ceo_R">Client</a></li>
                                        <li><a href="#" data-value="client_stat|Mediator/Liaisoner/Co-ordinator|ceo_R">Mediator/Liaisoner/Co-ordinator</a></li>
                                        <li><a href="#" data-value="client_stat|Awaiting Proposal Detail|ceo_R">Awaiting Proposal Detail</a></li>
                                        <li><a href="#" data-value="client_stat|Senior In-touch|ceo_R">Senior In-touch</a></li>
                                        <li><a href="#" data-value="client_stat|Planning To Visit|ceo_R">Planning To Visit</a></li>
                                        <li><a href="#" data-value="client_stat|In-touch,But Today Did Not Receive|ceo_R">In-touch,But Today Did Not Receive</a></li>
                                        <li><a href="#" data-value="client_stat|In-touch,But Not Receiving Few Days|ceo_R">In-touch,But Not Receiving Few Days</a></li>
                                        <li><a href="#" data-value="client_stat|Was In-touch, But Currently Declining The Call|ceo_R">Was In-touch, But Currently Declining The Call</a></li>
                                        <li><a href="#" data-value="client_stat|Shared Proposal|ceo_R">Shared Proposal</a></li>
                                        <li><a href="#" data-value="client_stat|No Fees,Investment|ceo_R">No Fees,Investment</a></li>
                                        <li><a href="#" data-value="client_stat|Seeking For Investor|ceo_R">Seeking For Investor</a></li>
                                        <li><a href="#" data-value="client_stat|Awaiting Update From Senior|ceo_R">Awaiting Update From Senior</a></li>
                                        <li><a href="#" data-value="client_stat|Language Issue|ceo_R">Language Issue</a></li>
                                        <li><a href="#" data-value="client_stat|Blocked My Number|ceo_R">Blocked My Number</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--for client wise-->
    <div class="align-items-center justify-content-center" style="display: none;" id="clntWiseFilterdiv">
        <h2 class="statheading">Client Statistics</h2>
        <h3 class="statheading" id="tblHd_clnt">Client Wise</h3>

        <div class="row justify-content-center">
            <div class="col-sm-2">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body"><a href="#" class="clnt_ATag" data-value="pcr_resp|0|ceo_C">Post Calling Recommendation (PCR) & Assesment- Response</a></div>

                </div>
            </div>
            <div class="col-sm-2">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body"><a href="#" class="clnt_ATag" data-value="pcr_pt|0|ceo_C">Post Calling Recommendation (PCR) & Assesment- Projected Target(PT)</a></div>

                </div>
            </div>
            <div class="col-sm-2" id="pcr_prcID" style="display: block;">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body"><a href="#" class="clnt_ATag" data-value="pcr_prc|0|ceo_C">Post Calling Recommendation (PCR) & Assesment- Probability Rate of Conversion(PRC)</a></div>

                </div>
            </div>
            <div class="col-sm-2">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body"><a href="#" class="clnt_ATag" data-value="pcr_client_rating|0|ceo_C">Post Calling Recommendation (PCR) & Assesment- Client's Classification /Ratings</a></div>

                </div>
            </div>
            <div class="col-sm-2">
                <div class="card text-white mb-4 cardColor">
                    <div class="card-body"><a href="#" class="clnt_ATag" data-value="client_stat|0|ceo_C">Client Status(Based upon your last entry for the particular client)</a></div>

                </div>
            </div>
        </div>
    </div>

</main>