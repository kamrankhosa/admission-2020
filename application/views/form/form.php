 <?php include 'header.php'; ?>

      
      <section id="main" style="padding-top: 30px;" id="top">
          <section class="wrapper">
            <!-- <h2 class="text-center"> Student Registration form-2020</h2> -->
            
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
              <div class="col-lg-2">
              </div>
              <div class="col-lg-8">
                  <div class="form-panel">
                      <!-- <h4 class="mb"><i class="fa fa-angle-right"></i> Form Elements</h4> -->
                      <form class="form-horizontal style-form" method="post" action="<?php echo base_url();?>home/registered" enctype="multipart/form-data"a name="form_reg">
                        <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                          <div class="col-sm-10 text-center">
                            <h1 style="font-style: italic;">Ghazi University, Dera Ghazi Khan</h1>
                            <h3>Application for Admission Fall 2020</h3>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-4 col-md-3 text-center">
                            <label>Challan No</label>
                            <input type="text" name="Challan" class="form-control" placeholder="Challan No" onchange="validate_challan(this)" required="">
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Bank Name</label>
                            <select name="bank" class="form-control" placeholder="Bank Name" required="">
                              <option value="Allied Bank" selected="">Allied Bank</option>
                              
                            </select>
                           <!--  <input type="text" name="bank" class="form-control" placeholder="Bank Name" required=""> -->
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Branch Code</label>
                            <input type="text" name="branch" class="form-control" placeholder="Branch Code" required="">
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Challan Date</label>
                            <input type="date" name="cdate" class="form-control" placeholder="Challan Date" required="">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-10">
                              <table class="table table-bordered table-condensed table-hover">
                                <tr>
                                  <th>Applying For</th>
                                  <td><input type="radio" name="applyforcourse" value="BS" required="" onchange="get_departments(this);hide_show(this);" id="applyforcourse"> Udergraduate</td>
                                  <td colspan="2"><input type="radio" name="applyforcourse" value="M.Sc" onchange="get_departments(this);hide_show(this);" id="applyforcourse"> MA/M.Sc/BBA(2year)</td>
                                  <tr>
                                      <td></td>
                                  <td><input type="radio" name="applyforcourse" value="MS" onchange="get_departments(this);hide_show(this);" id="applyforcourse"> MS/M.Phill/M.Sc(Hons)</td>
                                  <td colspan="2"><input type="radio" name="applyforcourse" value="B.Ed" onchange="get_departments(this);hide_show(this);" id="applyforcourse"> B.Ed</td>
                                  </tr>
                                 
                                </tr>
                                <tr>
                                  <th>Program</th>
                                  <td><input type="radio" name="psession" value="Morning" required=""> Morning</td>
                                  <td><input type="radio" name="psession" value="Evening"> Evening</td>
                                  <td><input type="radio" name="psession" value="Both"> Both</td>
                                </tr>
                                <tr>
                                  <th>Applying on</th>
                                  <td><input type="radio" name="applyon" value="Open Merit" id="merit" onchange="reserved1()"> Open Merit</td>
                                 
                                  <td colspan="2"><input type="radio" name="applyon" value="Quota" id="quota" onchange="reserved1()"> Quota</td>
                                  <!--<td><input type="radio" name="applyon" value="Self" id="self" onchange="reserved1()"> Self</td>-->
                                  <tr>
                                      <th></th>
                                      <td colspan="3">
                                        <select class="form-control" name="applyingon" id="applyon" onchange="reserved();">
                                    <option value="" hidden>Reserved Seats</option>
                                    <option value="GU teacher son/daughter">GU teacher son/daughter</option>
                                    <option value="GU employee son/daughter">GU employee son/daughter</option>
                                   
                                  </select></td> 
                                  </tr>

                                </tr>
                                <tr>
                                  <th>Nominees of/Category</th>
                                  <td><input type="radio" name="category" value="Sports" id="Sports" onchange="check_cat1();"> Sports</td>
                                  <td colspan="2"><input type="radio" name="category" value="Disabled" id="Disabled" onchange="check_cat1();"> Disabled</td>
                                  <tr>
                                      <td></td>
                                      <td colspan="3"><select class="form-control" name="category1" id="category" onchange="check_cat();">
                                    <option value="" hidden>Tribal Area</option>
                                    <option value="Tribal area of DGK">Tribal area of DGK</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="FATA">FATA</option>
                                    <option value="AJK">AJK</option>
                                  </select> </td>
                                      </tr>
                                  
                                </tr>
                                
                              </table>
                             
                            </div>
                              <label class="col-sm-2 col-sm-2 control-label">
                                 <div class="form-group text-center" style="position: relative;" >
                    <span class="img-div" style="position: relative;background-image: url('<?php echo base_url();?>assets/theme/img/profile.jpg'); " >
                      <div class="text-center img-placeholder">
                        <h4>Update image</h4>
                      </div>
                      <img src="<?php echo base_url();?>assets/theme/img/profile.jpg" onClick="triggerClick()" id="profileDisplay">
                    </span>
                    <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" required="" accept=".jpg,.jpeg,.png">
                    <label>Profile Image</label>
                  </div>
                              </label>
                            
                          </div>
                          
                  
                          
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Program</label>

                                  <select class="form-control" name="st_program" required="" id="prog" onchange="get_programs(this);">
                                    <option value="" hidden>Select a Program</option>
                                  </select>                   
                              </div>
                              <div class="col-sm-5">
                                <label>Department</label>
                                  <select class="form-control" name="department" required="" id="departments">
                                  <option hidden>Select a Department</option>
                                  <!-- <?php foreach ($departments as $department) {
                                    ?>
                                       <option value="<?php echo str_replace(' ', '_', $department->Department_name); ?>"><?php echo $department->Department_name;?></option>

                                  <?php } ?> -->
                                 
                                </select>
                                                      
                              </div>
                              
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Student Name</label>
                                  <input type="text" name="sname" placeholder="Student Name" class="form-control" id="sname">
                                                      
                              </div>
                               <div class="col-sm-5">
                              <label>Gender</label>
                                  <div class="radio">
                                <label>
                                  <input type="radio" name="gender" id="optionsRadios1" value="Male" >
                                 Male
                                </label>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                 <label>
                                  <input type="radio" name="gender" id="optionsRadios1" value="Female" >
                                Female
                                </label>
                              </div>
                                                       
                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                               <div class="col-sm-5">
                              <label>Father Name</label>
                                  <input type="text" name="fname" placeholder="Father Name" class="form-control" id="fname">
                                                       
                              </div>

                              <div class="col-sm-5">
                                <label>Father/Guardian Profession</label>
                                  <input type="text" name="profession" placeholder="Profession" class="form-control">
                                                      
                              </div>
                              

                          </div>
                              <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Monthly Income</label>
                                  <input type="text" name="m-income" placeholder="Monthly Income" class="form-control">
                                                      
                              </div>
                               <div class="col-sm-5">
                              <label>Candidate's CNIC / B-Form No <sub><span>(Applicant)</span></sub></label>
                                  <input type="text" name="cnic" class="form-control" placeholder="xxxxxxxxxxxxx" pattern="[0-9]{13}" id="cnic">
                               
                                                       
                              </div>
                             
                          </div>

                            <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Nationality</label>
                                <select name="nation" placeholder="Nationality" class="form-control" required="" id="nation">
                                  <option value="Pakistani" selected="">Pakistani</option>
                                  
                                </select>
                                  <!-- <input type="text" name="nation" placeholder="Nationality" class="form-control" required=""> -->
                                                      
                              </div>
                               <div class="col-sm-5">
                              <label>District of Domicile</label>
                                   <select class="form-control" name="domile" required id="dom" data-live-search="true">
                                    <option value="" disabled>Select The City</option>
    <option value="Islamabad">Islamabad</option>
    <option value="" disabled>Punjab Cities</option>
    <option value="Ahmed Nager Chatha">Ahmed Nager Chatha</option>
    <option value="Ahmadpur East">Ahmadpur East</option>
    <option value="Ali Khan Abad">Ali Khan Abad</option>
    <option value="Alipur">Alipur</option>
    <option value="Arifwala">Arifwala</option>
    <option value="Attock">Attock</option>
    <option value="Bhera">Bhera</option>
    <option value="Bhalwal">Bhalwal</option>
    <option value="Bahawalnagar">Bahawalnagar</option>
    <option value="Bahawalpur">Bahawalpur</option>
    <option value="Bhakkar">Bhakkar</option>
    <option value="Burewala">Burewala</option>
    <option value="Chillianwala">Chillianwala</option>
    <option value="Chakwal">Chakwal</option>
    <option value="Chichawatni">Chichawatni</option>
    <option value="Chiniot">Chiniot</option>
    <option value="Chishtian">Chishtian</option>
    <option value="Daska">Daska</option>
    <option value="Darya Khan">Darya Khan</option>
    <option value="Dera Ghazi Khan">Dera Ghazi Khan</option>
    <option value="Dhaular">Dhaular</option>
    <option value="Dina">Dina</option>
    <option value="Dinga">Dinga</option>
    <option value="Dipalpur">Dipalpur</option>
    <option value="Faisalabad">Faisalabad</option>
    <option value="Fateh Jhang">Fateh Jang</option>
    <option value="Ghakhar Mandi">Ghakhar Mandi</option>
    <option value="Gojra">Gojra</option>
    <option value="Gujranwala">Gujranwala</option>
    <option value="Gujrat">Gujrat</option>
    <option value="Gujar Khan">Gujar Khan</option>
    <option value="Hafizabad">Hafizabad</option>
    <option value="Haroonabad">Haroonabad</option>
    <option value="Hasilpur">Hasilpur</option>
    <option value="Haveli">Haveli</option>
    <option value="Lakha">Lakha</option>
    <option value="Jalalpur">Jalalpur</option>
    <option value="Jattan">Jattan</option>
    <option value="Jampur">Jampur</option>
    <option value="Jaranwala">Jaranwala</option>
    <option value="Jhang">Jhang</option>
    <option value="Jhelum">Jhelum</option>
    <option value="Kalabagh">Kalabagh</option>
    <option value="Karor Lal Esan">Karor Lal Esan</option>
    <option value="Kasur">Kasur</option>
    <option value="Kamalia">Kamalia</option>
    <option value="Kamoke">Kamoke</option>
    <option value="Khanewal">Khanewal</option>
    <option value="Khanpur">Khanpur</option>
    <option value="Kharian">Kharian</option>
    <option value="Khushab">Khushab</option>
    <option value="Kot Adu">Kot Adu</option>
    <option value="Jauharabad">Jauharabad</option>
    <option value="Lahore">Lahore</option>
    <option value="Lalamusa">Lalamusa</option>
    <option value="Layyah">Layyah</option>
    <option value="Liaquat Pur">Liaquat Pur</option>
    <option value="Lodhran">Lodhran</option>
    <option value="Malakwal">Malakwal</option>
    <option value="Mamoori">Mamoori</option>
    <option value="Mailsi">Mailsi</option>
    <option value="Mandi Bahauddin">Mandi Bahauddin</option>
    <option value="mian Channu">Mian Channu</option>
    <option value="Mianwali">Mianwali</option>
    <option value="Multan">Multan</option>
    <option value="Murree">Murree</option>
    <option value="Muridke">Muridke</option>
    <option value="Mianwali Bangla">Mianwali Bangla</option>
    <option value="Muzaffargarh">Muzaffargarh</option>
    <option value="Narowal">Narowal</option>
    <option value="Okara">Okara</option>
    <option value="Renala Khurd">Renala Khurd</option>
    <option value="Pakpattan">Pakpattan</option>
    <option value="Pattoki">Pattoki</option>
    <option value="Pir Mahal">Pir Mahal</option>
    <option value="Qaimpur">Qaimpur</option>
    <option value="Qila Didar Singh">Qila Didar Singh</option>
    <option value="Rabwah">Rabwah</option>
    <option value="Raiwind">Raiwind</option>
    <option value="Rajanpur">Rajanpur</option>
    <option value="Rahim Yar Khan">Rahim Yar Khan</option>
    <option value="Rawalpindi">Rawalpindi</option>
    <option value="Sadiqabad">Sadiqabad</option>
    <option value="Safdarabad">Safdarabad</option>
    <option value="Sahiwal">Sahiwal</option>
    <option value="Sangla Hill">Sangla Hill</option>
    <option value="Sarai Alamgir">Sarai Alamgir</option>
    <option value="Sargodha">Sargodha</option>
    <option value="Shakargarh">Shakargarh</option>
    <option value="Sheikhupura">Sheikhupura</option>
    <option value="Sialkot">Sialkot</option>
    <option value="Sohawa">Sohawa</option>
    <option value="Soianwala">Soianwala</option>
    <option value="Siranwali">Siranwali</option>
    <option value="Talagang">Talagang</option>
    <option value="Taxila">Taxila</option>
    <option value="Toba Tek  Singh">Toba Tek Singh</option>
    <option value="Vehari">Vehari</option>
    <option value="Wah Cantonment">Wah Cantonment</option>
    <option value="Wazirabad">Wazirabad</option>
    <option value="" disabled>Sindh Cities</option>
    <option value="Badin">Badin</option>
    <option value="Bhirkan">Bhirkan</option>
    <option value="Rajo Khanani">Rajo Khanani</option>
    <option value="Chak">Chak</option>
    <option value="Dadu">Dadu</option>
    <option value="Digri">Digri</option>
    <option value="Diplo">Diplo</option>
    <option value="Dokri">Dokri</option>
    <option value="Ghotki">Ghotki</option>
    <option value="Haala">Haala</option>
    <option value="Hyderabad">Hyderabad</option>
    <option value="Islamkot">Islamkot</option>
    <option value="Jacobabad">Jacobabad</option>
    <option value="Jamshoro">Jamshoro</option>
    <option value="Jungshahi">Jungshahi</option>
    <option value="Kandhkot">Kandhkot</option>
    <option value="Kandiaro">Kandiaro</option>
    <option value="Karachi">Karachi</option>
    <option value="Kashmore">Kashmore</option>
    <option value="Keti Bandar">Keti Bandar</option>
    <option value="Khairpur">Khairpur</option>
    <option value="Kotri">Kotri</option>
    <option value="Larkana">Larkana</option>
    <option value="Matiari">Matiari</option>
    <option value="Mehar">Mehar</option>
    <option value="Mirpur Khas">Mirpur Khas</option>
    <option value="Mithani">Mithani</option>
    <option value="Mithi">Mithi</option>
    <option value="Mehrabpur">Mehrabpur</option>
    <option value="Moro">Moro</option>
    <option value="Nagarparkar">Nagarparkar</option>
    <option value="Naudero">Naudero</option>
    <option value="Naushahro Feroze">Naushahro Feroze</option>
    <option value="Naushara">Naushara</option>
    <option value="Nawabshah">Nawabshah</option>
    <option value="Nazimabad">Nazimabad</option>
    <option value="Qambar">Qambar</option>
    <option value="Qasimabad">Qasimabad</option>
    <option value="Ranipur">Ranipur</option>
    <option value="Ratodero">Ratodero</option>
    <option value="Rohri">Rohri</option>
    <option value="Sakrand">Sakrand</option>
    <option value="Sanghar">Sanghar</option>
    <option value="Shahbandar">Shahbandar</option>
    <option value="Shahdadkot">Shahdadkot</option>
    <option value="Shahdadpur">Shahdadpur</option>
    <option value="Shahpur Chakar">Shahpur Chakar</option>
    <option value="Shikarpaur">Shikarpaur</option>
    <option value="Sukkur">Sukkur</option>
    <option value="Tangwani">Tangwani</option>
    <option value="Tando Adam Khan">Tando Adam Khan</option>
    <option value="Tando Allahyar">Tando Allahyar</option>
    <option value="Tando Muhammad Khan">Tando Muhammad Khan</option>
    <option value="Thatta">Thatta</option>
    <option value="Umerkot">Umerkot</option>
    <option value="Warah">Warah</option>
    <option value="" disabled>Khyber Cities</option>
    <option value="Abbottabad">Abbottabad</option>
    <option value="Adezai">Adezai</option>
    <option value="Alpuri">Alpuri</option>
    <option value="Akora Khattak">Akora Khattak</option>
    <option value="Ayubia">Ayubia</option>
    <option value="Banda Daud Shah">Banda Daud Shah</option>
    <option value="Bannu">Bannu</option>
    <option value="Batkhela">Batkhela</option>
    <option value="Battagram">Battagram</option>
    <option value="Birote">Birote</option>
    <option value="Chakdara">Chakdara</option>
    <option value="Charsadda">Charsadda</option>
    <option value="Chitral">Chitral</option>
    <option value="Daggar">Daggar</option>
    <option value="Dargai">Dargai</option>
    <option value="Darya Khan">Darya Khan</option>
    <option value="dera Ismail Khan">Dera Ismail Khan</option>
    <option value="Doaba">Doaba</option>
    <option value="Dir">Dir</option>
    <option value="Drosh">Drosh</option>
    <option value="Hangu">Hangu</option>
    <option value="Haripur">Haripur</option>
    <option value="Karak">Karak</option>
    <option value="Kohat">Kohat</option>
    <option value="Kulachi">Kulachi</option>
    <option value="Lakki Marwat">Lakki Marwat</option>
    <option value="Latamber">Latamber</option>
    <option value="Madyan">Madyan</option>
    <option value="Mansehra">Mansehra</option>
    <option value="Mardan">Mardan</option>
    <option value="Mastuj">Mastuj</option>
    <option value="Mingora">Mingora</option>
    <option value="Nowshera">Nowshera</option>
    <option value="Paharpur">Paharpur</option>
    <option value="Pabbi">Pabbi</option>
    <option value="Peshawar">Peshawar</option>
    <option value="Saidu Sharif">Saidu Sharif</option>
    <option value="Shorkot">Shorkot</option>
    <option value="Shewa Adda">Shewa Adda</option>
    <option value="Swabi">Swabi</option>
    <option value="Swat">Swat</option>
    <option value="Tangi">Tangi</option>
    <option value="Tank">Tank</option>
    <option value="Thall">Thall</option>
    <option value="Timergara">Timergara</option>
    <option value="Tordher">Tordher</option>
    <option value="" disabled>Balochistan Cities</option>
    <option value="Awaran">Awaran</option>
    <option value="Barkhan">Barkhan</option>
    <option value="Chagai">Chagai</option>
    <option value="Dera Bugti">Dera Bugti</option>
    <option value="Gwadar">Gwadar</option>
    <option value="Harnai">Harnai</option>
    <option value="Jafarabad">Jafarabad</option>
    <option value="Jhal Magsi">Jhal Magsi</option>
    <option value="Kacchi">Kacchi</option>
    <option value="Kalat">Kalat</option>
    <option value="Kech">Kech</option>
    <option value="Kharan">Kharan</option>
    <option value="Khuzdar">Khuzdar</option>
    <option value="Killa Abdullah">Killa Abdullah</option>
    <option value="Killa Saifullah">Killa Saifullah</option>
    <option value="Kohlu">Kohlu</option>
    <option value="Lasbela">Lasbela</option>
    <option value="Lehri">Lehri</option>
    <option value="Loralai">Loralai</option>
    <option value="Mastung">Mastung</option>
    <option value="Musakhel">Musakhel</option>
    <option value="Nasirabad">Nasirabad</option>
    <option value="Nushki">Nushki</option>
    <option value="Panjgur">Panjgur</option>
    <option value="Pishin valley">Pishin Valley</option>
    <option value="Quetta">Quetta</option>
    <option value="Sherani">Sherani</option>
    <option value="Sibi">Sibi</option>
    <option value="Sohbatpur">Sohbatpur</option>
    <option value="Washuk">Washuk</option>
    <option value="Zhob">Zhob</option>
    <option value="Ziarat">Ziarat</option>
                                  </select>  
                               
                                                       
                              </div>
                             
                          </div>
                              <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Religion</label>
                                  <select class="form-control" name="Religion" required="">
                                    <option hidden>Select your Religion</option>
                                    <option class="Islam">Islam</option>
                                    <option class="Christin">Christin</option>
                                    <option class="Hindu">Hindu</option>
                                    <option class="Sikh">Sikh</option>
                                    <option class="Other">Other</option>
                                  </select> 
                                                      
                              </div>
                                <div class="col-sm-5">
                              <label>Hafiz-e-Quran</label>
                                  <div class="radio">
                                <label>
                                  <input type="radio" name="hafiz" id="optionsRadios1" value="Yes" >
                                 Yes
                                </label>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                 <label>
                                  <input type="radio" name="hafiz" id="optionsRadios1" value="No" >
                                No
                                </label>
                              </div>
                                                       
                              </div>
                             
                          </div>

                            <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Blood Group</label>
                                   <select class="form-control" required="" name="Blood">
                                    <option hidden>Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    
                                     <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                     <option value="AB+">AB+</option>
                                    
                                    <option value="Dont Know">Dont Know</option>
                                  
                                  </select> 
                                                      
                              </div>
                               <div class="col-sm-5">
                              <label>Date of Birth<sub><small>(Applicant)</small></sub></label>
                                  <input type="date" name="dob" class="form-control" required="" onchange="Check_overage(this)" max="2005-01-01" id="dob">
                                  <div id="user1" style="color: red; padding-top: 5px;"></div>
                               
                                                       
                              </div>
                             
                          </div>
                             <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Email Address <sub><small>(Applicant)</small></sub></label>
                                  <input type="email" name="email" placeholder="Email Address " class="form-control" required="" id="email">
                                                      
                              </div>
                               <div class="col-sm-5">
                                <label>Cell No <sub><small>(Applicant)</small></sub></label>
                              
                                  <input type="text" name="cellno" class="form-control" placeholder="03xxxxxxxxx" id="phonenumber" pattern="[0-9]{11}">
                               
                                                       
                              </div>
                             
                          </div>
                          <div class="text-center">
                               <span style="color: red;">Person to be informed in emergency</span>
                          </div>
                     

                           <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                <label>Name</label>
                                  <input type="text" name="ep-name" placeholder="Person Name" class="form-control" id="ep-name">
                                                      
                              </div>
                               <div class="col-sm-5">
                                <label>Relation</label>
                              
                                  <input type="text" name="ep-relation" class="form-control" placeholder="Relation" id="ep-relation">                  
                              </div>
                          </div>

                          <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Cell No <sub><small>(Father / Guardian)</small></sub></label>
                              
                                  <input type="text" name="g-cellno" class="form-control" placeholder="03xxxxxxxxx" pattern="[0-9]{11}" id="g-cellno">
                                                      
                              </div>
                               <div class="col-sm-5">
                                <label>Address</label>
                                <textarea name="address" class="form-control" placeholder="Your full address" id="address"></textarea>
                              </div>
                             
                          </div>
                          <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-4">
                                  <label>Place of stay during study : </label>    
                              </div>
                               <div class="col-sm-2">
                               <div class="radio">
                                <label style="font-weight: bold;">
                                  <input type="radio" name="stay" value="Own House" >
                                 Own House
                                </label>
                                
                              </div>
                              </div>
                              <div class="col-sm-2">
                               <div class="radio">
                                 <label style="font-weight: bold;">
                                  <input type="radio" name="stay" value="Hostel" >
                                 Hostel
                                </label>
                                
                              </div>
                              </div>
                              <div class="col-sm-2">
                               <div class="radio">
                                <label style="font-weight: bold;">
                                  <input type="radio" name="stay" value="Other Place" >
                                 Other Place
                                </label>
                                
                              </div>
                              </div>
                             
                          </div>

                          <div class="text-center">
                               <span style="font-size: 16px; font-weight: bold; text-transform: uppercase;">Accademic Record</span>
                               <hr />
                          </div>
                          <legend style="" id="matric">
                            <h3 style="margin-left: 20px;">Matric</h3>

                            <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Board</label>
                                  <!-- <input type="text" name="matric_board" class="form-control" placeholder="Board / University" required=""> -->
                             <select class="form-control" required="" name="matric_board">
                                    <option>Select your board</option>
                                    <option value="Federal Board">Federal Board</option>

                                    <option value="BISE Bahawalpur">BISE Bahawalpur </option>
                                    <option value="BISE D.G.Khan">BISE D.G.Khan</option>
                                    <option value="BISE Faisalabad">BISE Faisalabad </option>
                                    <option value="BISE Gujranwala">BISE Gujranwala </option>
                                    <option value="BISE Lahore">BISE Lahore</option>
                                    <option value="BISE Multan">BISE Multan</option>
                                    <option value="BISE Rawalpindi">BISE Rawalpindi</option>
                                    <option value="BISE Sargodha">BISE Sargodha</option>
                                    <option value="Other">Other</option>

                                    <!--<option value="BISE ">BISE </option>-->
                                    <!--<option value="BISE ">BISE </option>-->
                                    <!--<option value="BISE ">BISE </option>-->
                                    <!--<option value="BISE ">BISE </option>-->
                                    <!--<option value="BISE ">BISE </option>-->
                                   
                                  </select>    
                              </div>
                              <div class="col-sm-5">
                                  <label>Passing Year</label>
                              <select class="form-control" required="" name="matric_year" id="matric_year">
                                <option>Select Year</option>
                                   <?php for ($i=1990; $i < 2020; $i++) { ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>

                                    <?php
                                    
                                   } ?>
                                  </select>    
                              </div>
                             
                          </div>
                          <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Roll No</label>
                              <input type="text" name="matric_rollno" class="form-control" placeholder="Roll No" required="">
                              </div>
                              <div class="col-sm-5">
                                  <label>Obtained Marks</label>
                              
                                     <input type="number" name="omarks" class="form-control" placeholder="Obtained Marks" min="1" required="" id="omarks" onchange="matric_percantage1(this);">

                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Total marks</label>
                              
                                     <input type="number" name="tmarks" class="form-control" placeholder="Total marks" min="1" onchange="matric_percantage(this);" id="tmarks">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Percentage</label>
                              <input type="text" name="percentage" class="form-control" placeholder="Percentage" id="mt_percent" disabled="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Division</label>
                              
                                     <input type="text" name="div" class="form-control" placeholder="Division" required="" id="m_div" disabled="">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Major Group</label>
                              <select class="form-control" required="" name="matric_subjects">
                                 <option>Select Group</option>
                                <option value="Science Group">Science Group</option>
                                <option value="Arts Group">Arts Group</option>
                                <option value="Others">Others</option>
                              </select>
                              </div>
                          </div>
                          </legend>

                          <legend style="" id="inter">
                            <h3 style="margin-left: 20px;">FA/F.Sc/Equivalent</h3>  
                            <p style="color:red; text-align:center;"> To apply for BS Program Only enter Intermediate (Part I) marks</p> 

                            <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Board</label>
                                  <!-- <input type="text" name="inter_board" class="form-control" placeholder="Board" required=""> -->
                              <select class="form-control" required="" name="inter_board">
                                    <option>Select your board</option>
                                    <option value="Federal Board">Federal Board </option>

                                    <option value="BISE Bahawalpur">BISE Bahawalpur </option>
                                    <option value="BISE D.G.Khan">BISE D.G.Khan</option>
                                    <option value="BISE Faisalabad">BISE Faisalabad </option>
                                    <option value="BISE Gujranwala">BISE Gujranwala </option>
                                    <option value="BISE Lahore">BISE Lahore</option>
                                    <option value="BISE Multan">BISE Multan</option>
                                    <option value="BISE Rawalpindi">BISE Rawalpindi</option>
                                    <option value="BISE Sargodha">BISE Sargodha</option>
                                    <option value="Other">Other</option>
                                    <!--<option value="BISE ">BISE </option>-->
                                    <!--<option value="BISE ">BISE </option>-->
                                    <!--<option value="BISE ">BISE </option>-->
                                    <!--<option value="BISE ">BISE </option>-->
                                    <!--<option value="BISE ">BISE </option>-->
                                   
                                  </select>     
                              </div>
                              <div class="col-sm-5">
                                  <label>Passing Year</label>
                              <select class="form-control" required="" name="inter_year" onchange="check_year(this);" id="inter_year">
                                   <option hidden>Select Year</option>
                                   <?php for ($i=1990; $i < 2020; $i++) { ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>

                                    <?php
                                    
                                   } ?>
                                  </select>    
                              </div>
                             
                          </div>
                          <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Roll No</label>
                              <input type="text" name="inter_rollno" class="form-control" placeholder="Roll No" required="">
                              </div>
                              <div class="col-sm-5">
                                  <label>Obtained Marks</label>
                              
                                     <input type="number" name="inter_omarks" class="form-control" placeholder="Obtained Marks" min="1" required="" id="inter_omarks" onchange="inter_percantage_cal1(this)">

                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Total marks</label>
                              
                                     <input type="number" name="inter_tmarks" class="form-control" placeholder="Total marks" min="1" onchange="inter_percantage_cal(this)" id="inter_tmarks">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Percentage</label>
                              <input type="text" name="inter_percentage" class="form-control" placeholder="Percentage" disabled="" id="inter_percentage">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Division</label>
                              
                                     <input type="text" name="inter_div" class="form-control" placeholder="Division" required="" disabled="" id="inter_div">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Major Group</label>
                              <select class="form-control" required="" name="inter_subjects">
                                <option>Select Group</option>
                                <option value="Pre-Medical">Pre-Medical</option>
                                <option value="Pre-Engineering">Pre-Engineering</option>
                                <option value="Pre-Agriculture">Pre-Agriculture</option>
                                <option value="Diploma of Inofrmation Technology">Diploma of Inofrmation Technology</option>
                                <option value="Diploma of Business Administration">Diploma of Business Administration</option>
                                <option value="Diploma of Agriculture">Diploma of Agriculture</option>
                                <option value="D.com">D.com</option>
                                 <option value="ICS">ICS</option>
                                <option value="F.A">F.A</option>
                                <option value="Others">Others</option>
                                
                              </select>
                              </div>
                          </div>
                          </legend>
                          <section id="bachelor">
                           <legend style="">
                            <h3 style="margin-left: 20px;" id="batch">BA/B.Sc/BBA/BS/B.Sc(Hons)</h3>

                            
                            <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>University</label>
                                  <input type="text" name="bachelor_board" class="form-control" placeholder="University" required="" id="bachelor_board" >
                              <!-- <select class="form-control" required="" name="bachelor_board">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>    --> 
                              </div>
                              <div class="col-sm-5">
                                  <label>Passing Year</label>
                              <select class="form-control" required="" name="bachelor_year" id="bachelor_year">
                                   <option>Select Year</option>
                                   <?php for ($i=1990; $i < 2021; $i++) { ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>

                                    <?php
                                    
                                   } ?>
                                  </select>    
                              </div>
                             
                          </div>
                          <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Roll No</label>
                              <input type="text" name="bachelor_rollno" class="form-control" placeholder="Roll No" required="" id="bachelor_rollno">
                              </div>
                              <div class="col-sm-5">
                                  <label>Obtained Marks</label>
                              
                                     <input type="number" name="bachelor_omarks" class="form-control" placeholder="Obtained Marks" min="1" required="" id="bachelor_omarks">

                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Total marks</label>
                              
                                     <input type="number" name="bachelor_tmarks" class="form-control" placeholder="Total marks" min="1" id="bachelor_tmarks" onchange="bachelor_percentage_cal(this)">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Percentage</label>
                              <input type="text" name="bachelor_percentage" class="form-control" placeholder="Percentage" id="bachelor_percentage" disabled="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Division / Grade / CGPA</label>
                              
                                     <input type="text" name="bachelor_div" class="form-control" placeholder="Division / Grade / CGPA" required="" id="bachelor_div">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Major Subjects</label>
                              <select multiple class="form-control" required="" name="bachelor_subjects[]" id="bachelor_subjects">
                                <option disabled="">Select you subjects</option>
                                
                                 <option value="Urdu">Urdu</option>
                                 <option value="Education">Education</option>
                                 <option value="English">English</option>
                                <option value="Zoology">Zoology</option>
                                <option value="Chemistry">Chemistry</option>
                                <option value="Mathematic (General)">Mathematic (General)</option>
                                <option value="Mathematic A">Mathematic A</option>
                                <option value="Mathematic B">Mathematic B</option>
                                <option value="Physics">Physics</option>
                                <option value="Computer Studies">Computer Studies</option>
                                <option value="Computer A">Computer A</option>
                                <option value="Computer B">Computer B</option>
                                <option value="Statistics">Statistics</option>
                                <option value="Bio chemistry">Bio chemistry</option>
                                <option value="Economics">Economics</option>
                                <option value="Advance Computer Studies">Advance Computer Studies</option>
                                 <option value="B.Sc.(Hons.) Agronomy">B.Sc.(Hons.) Agronomy</option>
                                <option value="B.Sc.(Hons.) Horticulture">B.Sc.(Hons.) Horticulture</option>
                                <option value="B.Sc.(Hons.) Plant Breeding & Genetics">B.Sc.(Hons.) Plant Breeding & Genetics</option>
                                <option value="Mathematic (General)">Mathematic (General)</option>
                                <option value="B.Sc.(Hons.) Agricultural Entomology">B.Sc.(Hons.) Agricultural Entomology</option>
                                <!-- <option value="Mathematic B">Mathematic B</option> -->
                                <option value="B.Sc.(Hons.) Soil Science">B.Sc.(Hons.) Soil Science</option>
                                <option value="BS Business Administration">BS Business Administration</option>
                                <option value="BS.Economics(4 year)">BS.Economics(4 year)</option>
                                
                                <option value="Islamic Studies ">Islmic Studies</option>
                                <option value="Sociology">Sociology</option>
                                <option value="ADP">ADP</option>
                                <option value="ADS">ADS</option>
                                
                                <option value="Others (Not Listed)">Others (Not Listed)(4 year)</option>
                              </select>
                              </div>
                          </div>
                          </legend>
                        </section>

                           <legend style="" id="master">
                            <h3 style="margin-left: 20px;">MA / M.Sc</h3>
 
                            <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>University</label>
                                  <input type="text" name="master_board" class="form-control" placeholder="University" required="" id="master_board">
                              <!-- <select class="form-control" required="" name="master_board">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>  -->   
                              </div>
                              <div class="col-sm-5">
                                  <label>Passing Year</label>
                              <select class="form-control" required="" name="master_year" id="master_year">
                                     <option>Select Year</option>
                                   <?php for ($i=1990; $i < 2021; $i++) { ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>

                                    <?php
                                    
                                   } ?>
                                  </select>    
                              </div>
                             
                          </div>
                          <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Roll No</label>
                              <input type="text" name="master_rollno" class="form-control" placeholder="Roll No" required="" id="master_rollno">
                              </div>
                              <div class="col-sm-5">
                                  <label>Obtained Marks</label>
                              
                                     <input type="number" name="master_omarks" class="form-control" placeholder="Obtained Marks" min="1" required="" id="master_omarks">

                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Total marks</label>
                              
                                     <input type="number" name="master_tmarks" class="form-control" placeholder="Total marks" min="1" id="master_tmarks" onchange="master_percentage_cal(this)">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Percentage</label>
                              <input type="text" name="master_percentage" class="form-control" placeholder="Percentage" id="master_percentage" disabled="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Division / Grade / CGPA</label>
                              
                                     <input type="text" name="master_div" class="form-control" placeholder="Division / Grade / CGPA" required="" id="master_div">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Major Subjects</label>
                              <select multiple class="form-control" required="" name="master_subjects" id="master_subjects">
<option disabled="">Select you subjects</option>
 <option value="Urdu">Urdu</option>
                                 <option value="Education">Education</option>
                                <option value="Botany">Botany</option>
                                 <option value="English">English</option>
                                <option value="Zoology">Zoology</option>
                                <option value="Chemistry">Chemistry</option>
                                <option value="Mathematic (General)">Mathematic (General)</option>
                                <option value="Mathematic A">Mathematic A</option>
                                <option value="Mathematic B">Mathematic B</option>
                                <option value="Physics">Physics</option>
                                <option value="Computer Studies">Computer Studies</option>
                                <option value="Computer A">Computer A</option>
                                <option value="Computer B">Computer B</option>
                                <option value="Statistics">Statistics</option>
                                <option value="Bio chemistry">Bio chemistry</option>
                                <option value="Economics">Economics</option>
                                <option value="Sociology">Sociology</option>
                                <option value="Advance Computer Studies">Advance Computer Studies</option>
                                
                                 <option value="B.Sc.(Hons.) Agronomy">B.Sc.(Hons.) Agronomy</option>
                                <option value="B.Sc.(Hons.) Horticulture">B.Sc.(Hons.) Horticulture</option>
                                <option value="B.Sc.(Hons.) Plant Breeding & Genetics">B.Sc.(Hons.) Plant Breeding & Genetics</option>
                                <option value="Mathematic (General)">Mathematic (General)</option>
                                <option value="B.Sc.(Hons.) Agricultural Entomology">B.Sc.(Hons.) Agricultural Entomology</option>
                                <!-- <option value="Mathematic B">Mathematic B</option> -->
                                <option value="B.Sc.(Hons.) Soil Science">B.Sc.(Hons.) Soil Science</option>
                                <option value="BS Business Administration">BS Business Administration</option>
                                <option value="BS.Economics(4 year)">BS.Economics(4 year)</option>
                                <option value="BS.English (Linguistics)(4year)">BS.English (Linguistics)(4year)</option>
                                <option value="BS.Zoology(4 year)">BS.Zoology(4 year)</option>
                                <option value="Islamic Studies ">Islmic Studies</option>
                                <option value="Others (Not Listed)">Others (Not Listed)</option>
                               <!--  <option value="Bio chemistry">Bio chemistry</option>
                                <option value="Economics">Economics</option>
                                <option value="Advance Computer Studies">Advance Computer Studies</option> -->
                              </select>
                              </div>
                          </div>
                          </legend>
                          <section>
                            <section id="gat">
                            
                          <div class="form-group">
                              

                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                  <h4>GAT Test</h4>
                              </div>
                              <div class="col-sm-2">
                                 <label>
                              <input type="radio" name="gat" value="Yes" onchange="show_yes_gat();"> Yes</label>
                              </div>
                              <div class="col-sm-2">
                                 <label> 
                              <input type="radio" name="gat" value="No" onchange="show_no_gat();"> No</label>
                              </div>
                            </div>
                             <div class="form-group" id="gat_yes" hidden="">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                               <div class="col-sm-3">
                                  <label>Please select validity date</label>
                              <input type="date" name="validity" class="form-control" placeholder="validity" id="validity">
                              </div>
                              <div class="col-sm-3">
                                  <label>GAT Roll No</label>
                              <input type="text" name="gatrollno" class="form-control" placeholder="GAT Roll No" id="gatrollno">
                              </div>
                               <div class="col-sm-3">
                                  <label>GAT Obtained marks</label>
                              <input type="text" name="gatmarks" class="form-control" placeholder="GAT Obtained marks" id="gatmarks">
                              </div>
                            </div>

                            <div class="form-group" id="gat_no" hidden="">
                                <h4 style="text-align: center;">Apply for GU Departmental test</h4>
                                <p style="color:red; text-align: center;">Candidate have to pay fee voucher of RS. 1000 for departmental test.</p>

                              <div class="form-group">
                          <div class="col-sm-4 col-md-3 text-center">
                            <label>Challan No</label>
                            <input type="text" name="gat_Challan" class="form-control" placeholder="Challan No" onchange="validate_challan(this)" id="gat_Challan">
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Bank Name</label>
                            <select name="gat_bank" class="form-control" placeholder="Bank Name" id="gat_bank">
                              <option value="Allied Bank" selected="">Allied Bank</option>
                              
                            </select>
                           <!--  <input type="text" name="bank" class="form-control" placeholder="Bank Name" required=""> -->
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Branch Code</label>
                            <input type="text" name="gat_branch" class="form-control" placeholder="Branch Code" id="gat_branch">
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Challan Date</label>
                            <input type="date" name="gat_cdate" class="form-control" placeholder="Challan Date" id="gat_cdate">
                          </div>
                        </div>
                            </div>
                              </section>
                          </section>

                          <div class="form-group">

                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-3">
                             <!-- <div class="showback"> -->
                <!-- <h4><i class="fa fa-angle-right"></i> Modal Example</h4> -->
            <!-- Button trigger modal -->
           <!--  <button class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#preview_myModal" onclick="preview()">
              Preview
            </button> -->
            
            <!-- Modal -->
            <div class="modal fade" id="preview_myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Review your application details</h4>
                  </div>
                  <div class="modal-body">
                     <div class="row" style="text-align: center;">
                      <div class="col-lg-12">
                        Program : <h3 id="prg"></h3>
                      </div>
                     
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <strong>Your name : </strong><span id="pname"></span>
                      </div>
                      <div class="col-lg-6">
                        <strong>Father name : </strong><span id="pfname"></span>
                      </div>
                      
                    </div>
                     <div class="row">
                      <div class="col-lg-6">
                        <strong>Your CNIC : </strong><span id="pcnic"></span>
                      </div>
                      <div class="col-lg-6">
                          <strong>Your Date of birth : </strong><span id="pdob"></span>
                      </div>
                      
                    </div>
                     <div class="row">
                      <div class="col-lg-6">
                       <strong>Your Cell no : </strong><span id="pcellno"></span>
                      </div>
                      <div class="col-lg-6">
                        <strong>Your Email : </strong><span id="pemail"></span>
                      </div>
                      
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <strong>Nationality : </strong><span id="pnation"></span>
                      </div>
                      <div class="col-lg-6">

                        <strong>Domicile : </strong><span id="pdom"></span>
                      </div>
                      
                    </div>
                    <hr>
                    <h4 style="text-align: center; color: red;">Emergency contact Info</h4>
                    <hr />
                     <div class="row">
                      <div class="col-lg-6">
                        <strong>Person name : </strong><span id="epname"></span>
                      </div>
                      <div class="col-lg-6">

                        <strong>Relation : </strong><span id="prel"></span>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <strong>Cell No : </strong><span id="pcell"></span>
                      </div>
                      <div class="col-lg-6">

                        <strong>Address : </strong><span id="padd"></span>
                      </div>
                      
                    </div>
                    


                    <script>
                      function preview() {
                        var dpt =$('#departments').val();
                        var prg = $('#prog').val();

                        var sname = $('#sname').val();
                        var fname = $('#fname').val();
                        var pcnic = $('#cnic').val();
                        var pnation = $('#nation').val();

                        var dob = $('#dob').val();
                        var email = $('#email').val();
                        var cellno = $('#phonenumber').val();
                        var dom = $('#dom').val();

                        var epname = $('#ep-name').val();
                        var prel = $('#ep-relation').val();
                        var pcell = $('#g-cellno').val();
                        var padd = $('#address').val();
                        document.getElementById('pname').innerHTML=sname;
                        document.getElementById('pfname').innerHTML=fname;
                        document.getElementById('pcnic').innerHTML=pcnic;
                        document.getElementById('pnation').innerHTML=pnation;
                        document.getElementById('pdob').innerHTML=dob;
                        document.getElementById('pcellno').innerHTML=cellno;
                        document.getElementById('pemail').innerHTML=email;
                        document.getElementById('pdom').innerHTML=dom;
                        document.getElementById('prg').innerHTML=prg;

                        document.getElementById('epname').innerHTML=epname;
                        document.getElementById('prel').innerHTML=prel;
                        document.getElementById('pcell').innerHTML=pcell;
                        document.getElementById('padd').innerHTML=padd;
                        // document.getElementById('pname').innerHTML=sname;

                        // document.getElementById('pname').innerHTML=sname;
                        // document.getElementById('pname').innerHTML=sname;
                        // document.getElementById('pname').innerHTML=sname;
                        // document.getElementById('pname').innerHTML=sname;
                        // document.getElementById('pname').innerHTML=sname;
                        // document.getElementById('pname').innerHTML=sname;
                        // document.getElementById('pname').value=abc;
                      }
                     
                  // document.write(5+6);
                </script> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>              
              </div>
                              <!-- </div> -->

                              <div class="col-sm-4">
                              
                      <input type="submit" name="register" class="btn btn-primary btn-lg btn-block" value="Submit" onclick="check_image();" onsubmit="confirm('Please read carefully entered data before submission. Candidate will be resposible for providing wrong information.');">

                              </div>
                             
                          </div>
                          
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
        
            
    </section>
      </section><!-- /MAIN CONTENT -->

      
    <?php include 'footer.php'; ?>
