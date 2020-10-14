    <?php $this->load->view('form/header');
    foreach ($ms_students as $details) {
    
     ?>

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
                      <form class="form-horizontal style-form" method="post" action="<?php echo base_url();?>admin/updated_ms_student_details" enctype="multipart/form-data"a name="form_reg">
                        <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                          <div class="col-sm-10 text-center">
                            <h1 style="font-style: italic;">Ghazi University, Dera Ghazi Khan</h1>
                            <h3>Application for Registration 2020</h3>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-4 col-md-3 text-center">
                            <label>Challan No</label>
                            <input type="text" name="Challan" class="form-control" placeholder="Challan No" value="<?php echo $details->challan; ?>">
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Bank Name</label>
                            <select name="bank" class="form-control" placeholder="Bank Name">
                              <option value="Allied Bank" selected="">Allied Bank</option>
                              
                            </select>
                           <!--  <input type="text" name="bank" class="form-control" placeholder="Bank Name"> -->
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Branch Code</label>
                            <input type="text" name="branch" class="form-control" placeholder="Branch Code" value="<?php echo $details->bank_branch; ?>">
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Challan Date</label>
                            <input type="date" name="cdate" class="form-control" placeholder="Challan Date" value="<?php echo $details->challan_date; ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-1">
                            
                          </div>
                          <div class="col-sm-10">
                              <table class="table table-bordered table-condensed table-hover">
                                <tr>
                                  <th>Applying For</th>
                                  <td><input type="radio" name="applyforcourse" value="BS" <?php if ($details->applyforcourse=='BS') {
                                   echo "checked";
                                  } ?>> Udergraduate</td>
                                  <td colspan="2"><input type="radio" name="applyforcourse" value="M.Sc" <?php if ($details->applyforcourse=='M.Sc') {
                                   echo "checked";
                                  } ?>> MA/M.Sc/BBA(2year)</td>
                                  <tr>
                                      <td></td>
                                  <td><input type="radio" name="applyforcourse" value="MS" <?php if ($details->st_program !='B.Ed') {
                                   echo "checked";
                                  } ?>> MS/M.Phill/M.Sc(Hons)</td>
                                  <td colspan="2"><input type="radio" name="applyforcourse" value="B.Ed" <?php if ($details->st_program=='B.Ed') {
                                   echo "checked";
                                  } ?>> B.Ed</td>
                                  </tr>
                                 
                                </tr>
                                <tr>
                                  <th>Program</th>
                                  <td><input type="radio" name="psession" value="Morning"<?php if ($details->psession=='Morning') {
                                   echo "checked";
                                  } ?>> Morning</td>
                                  <td><input type="radio" name="psession" value="Evening"<?php if ($details->psession=='Evening') {
                                   echo "checked";
                                  } ?>> Evening</td>
                                  <td><input type="radio" name="psession" value="Both"<?php if ($details->psession=='Both') {
                                   echo "checked";
                                  } ?>> Both</td>
                                </tr>
                                <tr>
                                  <th>Nominees of</th>
                                  <td><input type="radio" name="applyon" value="Open Merit" id="merit"<?php if ($details->applyon=='Open Merit') {
                                   echo "checked";
                                  } ?>> Open Merit</td>
                                 
                                  <td colspan="2"><input type="radio" name="applyon" value="Quota" id="quota" <?php if ($details->applyon=='Quota') {
                                   echo "checked";
                                  } ?>> Quota</td>
                                  <tr>
                                      <th></th>
                                      <td colspan="3">
                                        <select class="form-control" name="applyingon" id="applyon">
                                    <option value="" hidden>Reserved Seats</option>
                                    <option value="GU teacher son/daughter">GU teacher son/daughter</option>
                                    <option value="GU employee son/daughter">GU employee son/daughter</option>
                                   
                                  </select></td> 
                                  </tr>

                                </tr>
                                <tr>
                                  <th>Category</th>
                                  <td><input type="radio" name="category" value="Sports" id="Sports" <?php if ($details->category=='Sports') {
                                   echo "checked";
                                  } ?>> Sports</td>
                                  <td colspan="2"><input type="radio" name="category" value="Disabled" id="Disabled" <?php if ($details->category=='Disabled') {
                                   echo "checked";
                                  } ?>> Disabled</td>
                                  <tr>
                                      <td></td>
                                      <td colspan="3"><select class="form-control" name="category1" id="category">
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
                          <!--     <label class="col-sm-2 col-sm-2 control-label">
                                 <div class="form-group text-center" style="position: relative;" >
                    <span class="img-div" style="position: relative;background-image: url('<?php echo base_url();?>assets/theme/img/profile.jpg'); " >
                      <div class="text-center img-placeholder">
                        <h4>Update image</h4>
                      </div>
                      <img src="<?php echo base_url();?>assets/theme/img/profile.jpg" onClick="triggerClick()" id="profileDisplay">
                    </span>
                    <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" accept=".jpg,.jpeg,.png" value="<?php echo $details->profile; ?>">
                    <label>Profile Image</label>
                  </div>
                              </label> -->
                            
                          </div>
                          
                  
                          
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Program</label>

                                  <select class="form-control" name="st_program">
                                    <option value="<?php echo $details->st_program; ?>" selected><?php echo $details->st_program; ?></option>
                                    <option value="B.Ed">B.Ed</option>
                                    <?php foreach($ms_programs as $program){?>
        <option value="<?php echo $program->Program_name; ?>"><?php echo $program->Program_name; ?></option>
                                  <?php  } ?>
                                  </select>                   
                              </div>
                              <div class="col-sm-5">
                                <label>Department</label>
                                  <select class="form-control" name="department" id="departments">
                                  <option value="<?php echo $details->department; ?>" selected><?php echo $details->department; ?></option>
                                  <?php foreach ($departments as $department) {
                                    ?>
                                      <option value="<?php echo $department->Department_name; ?>"><?php echo $department->Department_name;?></option>

                                  <?php } ?>
                                 
                                </select>
                                                      
                              </div>
                              
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Student Name</label>
                                  <input type="text" name="sname" placeholder="Student Name" class="form-control" id="sname" value="<?php echo $details->sname; ?>">
                                                      
                              </div>
                               <div class="col-sm-5">
                              <label>Gender</label>
                                  <div class="radio">
                                <label>
                                  <input type="radio" name="gender" id="optionsRadios1" value="Male"<?php if ($details->gender=='Male') {
                                   echo "checked";
                                  } ?> >
                                 Male
                                </label>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                 <label>
                                  <input type="radio" name="gender" id="optionsRadios1" value="Female"  <?php if ($details->gender=='Female') {
                                   echo "checked";
                                  } ?>>
                                Female
                                </label>
                              </div>
                                                       
                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                               <div class="col-sm-5">
                              <label>Father Name</label>
                                  <input type="text" name="fname" placeholder="Father Name" class="form-control" id="fname" value="<?php echo $details->fname; ?>">
                                                       
                              </div>

                              <div class="col-sm-5">
                                <label>Father/Guardian Profession</label>
                                  <input type="text" name="profession" placeholder="Profession" class="form-control" value="<?php echo $details->profession; ?>">
                                                      
                              </div>
                              

                          </div>
                              <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Monthly Income</label>
                                  <input type="text" name="m-income" placeholder="Monthly Income" class="form-control" value="<?php echo $details->m_income; ?>">
                                                      
                              </div>
                               <div class="col-sm-5">
                              <label>Candidate's CNIC / B-Form No <sub><span>(Applicant)</span></sub></label>
                                  <input type="text" name="cnic" class="form-control" placeholder="xxxxxxxxxxxxx" pattern="[0-9]{13}" id="cnic" value="<?php echo $details->cnic; ?>">
                               
                                                       
                              </div>
                             
                          </div>

                            <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Nationality</label>
                                <select name="nation" placeholder="Nationality" class="form-control" id="nation">
                                  <option value="Pakistani" selected="">Pakistani</option>
                                  
                                </select>
                                  <!-- <input type="text" name="nation" placeholder="Nationality" class="form-control"> -->
                                                      
                              </div>
                               <div class="col-sm-5">
                              <label>District of Domicile</label>
                                   <select class="form-control" name="domile" id="dom" data-live-search="true">
                                    <option value="<?php echo $details->domile; ?>" selected><?php echo $details->domile; ?></option>
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
                                  <select class="form-control" name="Religion">
                                   <option value="<?php echo $details->religion; ?>" selected><?php echo $details->religion; ?></option>
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
                                  <input type="radio" name="hafiz" id="optionsRadios1" value="Yes" <?php if ($details->hafiz=='Yes') {
                                   echo "checked";
                                  } ?>>
                                 Yes
                                </label>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                 <label>
                                  <input type="radio" name="hafiz" id="optionsRadios1" value="No" <?php if ($details->hafiz=='No') {
                                   echo "checked";
                                  } ?>>
                                No
                                </label>
                              </div>
                                                       
                              </div>
                             
                          </div>

                            <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Blood Group</label>
                                   <select class="form-control" name="Blood">
                                    <option value="<?php echo $details->blood_group; ?>" selected><?php echo $details->blood_group; ?></option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    
                                     <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                     <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                  
                                  </select> 
                                                      
                              </div>
                               <div class="col-sm-5">
                              <label>Date of Birth<sub><small>(Applicant)</small></sub></label>
                                  <input type="date" name="dob" class="form-control" onchange="Check_overage(this)" max="2005-01-01" id="dob" value="<?php echo $details->dob; ?>" >
                                  <div id="user1" style="color: red; padding-top: 5px;"></div>
                               
                                                       
                              </div>
                             
                          </div>
                             <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-5">
                                <label>Email Address <sub><small>(Applicant)</small></sub></label>
                                  <input type="email" name="email" placeholder="Email Address " class="form-control" id="email" value="<?php echo $details->email; ?>" >
                                                      
                              </div>
                               <div class="col-sm-5">
                                <label>Cell No <sub><small>(Applicant)</small></sub></label>
                              
                                  <input type="text" name="cellno" class="form-control" placeholder="03xxxxxxxxx" id="phonenumber" pattern="[0-9]{11}" value="<?php echo $details->cellno; ?>" >
                               
                                                       
                              </div>
                             
                          </div>
                          <div class="text-center">
                               <span style="color: red;">Person to be informed in emergency</span>
                          </div>
                     

                           <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                <label>Name</label>
                                  <input type="text" name="ep-name" placeholder="Person Name" class="form-control" id="ep-name" value="<?php echo $details->ep_name; ?>" >
                                                      
                              </div>
                               <div class="col-sm-5">
                                <label>Relation</label>
                              
                                  <input type="text" name="ep-relation" class="form-control" placeholder="Relation" id="ep-relation" value="<?php echo $details->ep_relation; ?>">                  
                              </div>
                          </div>

                          <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Cell No <sub><small>(Father / Guardian)</small></sub></label>
                              
                                  <input type="text" name="g-cellno" class="form-control" placeholder="03xxxxxxxxx" pattern="[0-9]{11}" id="g-cellno" value="<?php echo $details->g_cellno; ?>">
                                                      
                              </div>
                               <div class="col-sm-5">
                                <label>Address</label>
                                <textarea name="address" class="form-control" placeholder="Your full address" id="address" value="<?php echo $details->address; ?>"><?php echo $details->address; ?></textarea>
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
                                  <input type="radio" name="stay" value="Own House" <?php if ($details->stay=='Own House') {
                                   echo "checked";
                                  } ?>>
                                 Own House
                                </label>
                                
                              </div>
                              </div>
                              <div class="col-sm-2">
                               <div class="radio">
                                 <label style="font-weight: bold;">
                                  <input type="radio" name="stay" value="Hostel" <?php if ($details->stay=='Hostel') {
                                   echo "checked";
                                  } ?>>
                                 Hostel
                                </label>
                                
                              </div>
                              </div>
                              <div class="col-sm-2">
                               <div class="radio">
                                <label style="font-weight: bold;">
                                  <input type="radio" name="stay" value="Other Place" <?php if ($details->stay=='Other Place') {
                                   echo "checked";
                                  } ?>>
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
                                  <!-- <input type="text" name="matric_board" class="form-control" placeholder="Board / University"> -->
                             <select class="form-control" name="matric_board">
                                    <option value="<?php echo $details->matric_board; ?>" selected><?php echo $details->matric_board; ?></option>
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
                              <select class="form-control" name="matric_year" id="matric_year">
                                 <option value="<?php echo $details->matric_year; ?>" selected><?php echo $details->matric_year; ?></option>
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
                              <input type="text" name="matric_rollno" class="form-control" placeholder="Roll No" value="<?php echo $details->matric_rollno; ?>">
                              </div>
                              <div class="col-sm-5">
                                  <label>Obtained Marks</label>
                              
                                     <input type="number" name="omarks" class="form-control" placeholder="Obtained Marks" min="1" id="omarks" onchange="matric_percantage1(this);" value="<?php echo $details->matric_omarks; ?>">

                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Total marks</label>
                              
                                     <input type="number" name="tmarks" class="form-control" placeholder="Total marks" min="1" onchange="matric_percantage(this);" id="tmarks" value="<?php echo $details->matric_tmarks; ?>">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Percentage</label>
                              <input type="text" name="percentage" class="form-control" placeholder="Percentage" id="mt_percent" disabled="" value="<?php echo $details->matric_percentage; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Division</label>
                              
                                     <input type="text" name="div" class="form-control" placeholder="Division" id="m_div" disabled="" value="<?php echo $details->matric_div; ?>">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Major Group</label>
                              <select class="form-control" name="matric_subjects">
                                 <option value="<?php echo $details->matric_subjects; ?>" selected><?php echo $details->matric_subjects; ?></option>
                                <option value="Scince Group">Science Group</option>
                                <option value="Arts Group">Arts Group</option>
                                <option value="Others">Others</option>
                              </select>
                              </div>
                          </div>
                          </legend>

                          <legend style="" id="inter">
                            <h3 style="margin-left: 20px;">FA/F.Sc/Equivalent</h3>  <span style="color:red;"> To apply for BS Program Only enter Intermediate (Part I) marks</span> 

                            <div class="form-group">
                              
                              <label class="col-sm-1 col-sm-1 control-label"></label>
                             
                              <div class="col-sm-5">
                                  <label>Board</label>
                                  <!-- <input type="text" name="inter_board" class="form-control" placeholder="Board"> -->
                              <select class="form-control" name="inter_board">
                                    <option value="<?php echo $details->inter_board; ?>" selected><?php echo $details->inter_board; ?></option>
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
                              <select class="form-control" name="inter_year" id="inter_year">
                                  <option value="<?php echo $details->inter_year; ?>" selected><?php echo $details->inter_year; ?></option>
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
                              <input type="text" name="inter_rollno" class="form-control" placeholder="Roll No" value="<?php echo $details->inter_rollno; ?>">
                              </div>
                              <div class="col-sm-5">
                                  <label>Obtained Marks</label>
                              
                                     <input type="number" name="inter_omarks" class="form-control" placeholder="Obtained Marks" min="1" id="inter_omarks"  value="<?php echo $details->inter_omarks; ?>">

                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Total marks</label>
                              
                                     <input type="number" name="inter_tmarks" class="form-control" placeholder="Total marks" min="1" id="inter_tmarks" value="<?php echo $details->inter_tmarks; ?>">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Percentage</label>
                              <input type="text" name="inter_percentage" class="form-control" placeholder="Percentage" disabled="" id="inter_percentage" value="<?php echo $details->inter_percentage; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Division</label>
                              
                                     <input type="text" name="inter_div" class="form-control" placeholder="Division" disabled="" id="inter_div" value="<?php echo $details->inter_div; ?>">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Major Group</label>
                              <select class="form-control" name="inter_subjects">
                               <option value="<?php echo $details->inter_subjects; ?>" selected><?php echo $details->inter_subjects; ?></option>
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
                                  <input type="text" name="bachelor_board" class="form-control" placeholder="University" id="bachelor_board" value="<?php echo $details->bachelor_board; ?>">
                              <!-- <select class="form-control"="" name="bachelor_board">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                     <option value="<?php echo $details->inter_board; ?>" selected><?php echo $details->inter_board; ?></option>
                                  </select>    --> 
                              </div>
                              <div class="col-sm-5">
                                  <label>Passing Year</label>
                              <select class="form-control" name="bachelor_year" id="bachelor_year">
                                  <option value="<?php echo $details->bachelor_year; ?>" selected><?php echo $details->bachelor_year; ?></option>
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
                              <input type="text" name="bachelor_rollno" class="form-control" placeholder="Roll No" id="bachelor_rollno"value="<?php echo $details->bachelor_rollno; ?>">
                              </div>
                              <div class="col-sm-5">
                                  <label>Obtained Marks</label>
                              
                                     <input type="number" name="bachelor_omarks" class="form-control" placeholder="Obtained Marks" min="1" id="bachelor_omarks" value="<?php echo $details->bachelor_omarks; ?>">

                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Total marks</label>
                              
                                     <input type="number" name="bachelor_tmarks" class="form-control" placeholder="Total marks" min="1" id="bachelor_tmarks" value="<?php echo $details->bachelor_tmarks; ?>">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Percentage</label>
                              <input type="text" name="bachelor_percentage" class="form-control" placeholder="Percentage" id="bachelor_percentage" disabled="" value="<?php echo $details->bachelor_percentage; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Division / Grade / CGPA</label>
                              
                                     <input type="text" name="bachelor_div" class="form-control" placeholder="Division / Grade / CGPA" id="bachelor_div" value="<?php echo $details->bachelor_div; ?>">

                              </div>
                           
                              <div class="col-sm-5">
                                  <label>Major Subjects</label>
                              <select multiple class="form-control" name="bachelor_subjects[]" id="bachelor_subjects">
                                <?php $a=explode(',', $details->bachelor_subjects);$n=0;
                             foreach ($a as $key => $value) {?>

                                <option selected="" value="<?php echo $value; ?>"><?php echo $value; ?></option>
                              <?php }?>
                                <!-- <?php echo explode(',', $details->bachelor_subjects) ?> -->
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
                                  <input type="text" name="master_board" class="form-control" placeholder="University" id="master_board"value="<?php echo $details->master_board; ?>">
                              <!-- <select class="form-control" name="master_board">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>  -->   
                              </div>
                              <div class="col-sm-5">
                                  <label>Passing Year</label>
                              <select class="form-control" name="master_year" id="master_year">
                                    <option value="<?php echo $details->master_year; ?>" selected><?php echo $details->master_year; ?></option>
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
                              <input type="text" name="master_rollno" class="form-control" placeholder="Roll No" id="master_rollno" value="<?php echo $details->master_rollno; ?>">
                              </div>
                              <div class="col-sm-5">
                                  <label>Obtained Marks</label>
                              
                                     <input type="number" name="master_omarks" class="form-control" placeholder="Obtained Marks" min="1" id="master_omarks" value="<?php echo $details->master_omarks; ?>">

                              </div>
                             
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Total marks</label>
                              
                                     <input type="number" name="master_tmarks" class="form-control" placeholder="Total marks" min="1" id="master_tmarks" value="<?php echo $details->master_tmarks; ?>">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Percentage</label>
                              <input type="text" name="master_percentage" class="form-control" placeholder="Percentage" id="master_percentage" disabled="" value="<?php echo $details->master_percentage; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                              <div class="col-sm-5">
                                  <label>Division / Grade / CGPA</label>
                              
                                     <input type="text" name="master_div" class="form-control" placeholder="Division / Grade / CGPA" id="master_div" value="<?php echo $details->master_div; ?>">

                              </div>
                             
                              <div class="col-sm-5">
                                  <label>Major Subjects</label>
                              <select multiple class="form-control" name="master_subjects" id="master_subjects">
                                <?php $a=explode(',', $details->master_subjects);$n=0;
                             foreach ($a as $key => $value) {?>

                                <option selected="" value="<?php echo $value; ?>"><?php echo $value; ?></option>
                              <?php }?>
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
                              <?php $gat_data=$this->db->query("SELECT * FROM `tbl_gat_data` WHERE student_id='$details->ID'")->row();?>
                              <div class="col-sm-2">
                                 <label>
                              <input type="radio" name="gat" value="Yes" onchange="show_yes_gat();" <?php if ($gat_data->attempted=='Yes') {
                               echo "checked";
                              }?>> Yes</label>
                              </div>
                              <div class="col-sm-2">
                                 <label> 
                              <input type="radio" name="gat" value="No" onchange="show_no_gat();" <?php if ($gat_data->attempted=='No') {
                               echo "checked";
                              }?>> No</label>
                              </div>
                            </div>
                             <div class="form-group" id="gat_yes" <?php if ($gat_data->attempted=='No') {
                               echo "hidden";
                              }?>>
                              <label class="col-sm-1 col-sm-1 control-label"></label>

                               <div class="col-sm-3">
                                  <label>Please select validity date</label>
                              <input type="date" name="validity" class="form-control" placeholder="validity" id="validity" value="<?php echo $gat_data->validity_date ?>">
                              </div>
                              <div class="col-sm-3">
                                  <label>GAT Roll No</label>
                              <input type="text" name="gatrollno" class="form-control" placeholder="GAT Roll No" id="gatrollno" value="<?php echo $gat_data->gat_roll_no ?>">
                              </div>
                               <div class="col-sm-3">
                                  <label>GAT Obtained marks</label>
                              <input type="text" name="gatmarks" class="form-control" placeholder="GAT Obtained marks" id="gatmarks">
                              </div>
                            </div>

                            <div class="form-group" id="gat_no"  <?php if ($gat_data->attempted=='Yes') {
                               echo "hidden";
                              }?>>
                                <h4 style="text-align: center;">Apply for GU Departmental test</h4>
                                <p style="color:red; text-align: center;">Candidate have to pay fee voucher of RS. 1000 for departmental test.</p>

                              <div class="form-group">
                          <div class="col-sm-4 col-md-3 text-center">
                            <label>Challan No</label>
                            <input type="text" name="gat_Challan" class="form-control" placeholder="Challan No" onchange="validate_challan(this)" id="gat_Challan" value="<?php echo $gat_data->gat_Challan ?>">
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Bank Name</label>
                            <select name="gat_bank" class="form-control" placeholder="Bank Name" id="gat_bank">
                              <option value="Allied Bank" selected="">Allied Bank</option>
                              
                            </select>
                           <!--  <input type="text" name="bank" class="form-control" placeholder="Bank Name"> -->
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Branch Code</label>
                            <input type="text" name="gat_branch" class="form-control" placeholder="Branch Code" id="gat_branch" value="<?php echo $gat_data->gat_branch ?>">
                          </div>
                          <div class="col-sm-3 text-center">
                            <label>Challan Date</label>
                            <input type="date" name="gat_cdate" class="form-control" placeholder="Challan Date" id="gat_cdate" value="<?php echo $gat_data->gat_cdate ?>">
                          </div>
                        </div>
                            </div>
                              </section>

                          <input type="text" name="id" value="<?php echo $details->ID;?>" hidden>
                          
                          <?php } ?>
                            
                        <div class="form-group">

                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-2">
                                <h4>Your remarks</h4>
              </div>
                              <div class="col-sm-8">
                              
                      <textarea class="form-control" placeholder="Your remarks about what you updated in the form. Thank you!" name="remarks"></textarea>

                              </div>
                             
                          </div>
                          <div class="form-group">

                              <label class="col-sm-1 col-sm-1 control-label"></label>
                              <div class="col-sm-3">
              </div>
                              <div class="col-sm-4">
                              
                      <input type="submit" name="update" class="btn btn-success btn-lg btn-block" value="UPDATE">

                              </div>
                             
                          </div>
                          
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
        
            
    </section>
      </section><!-- /MAIN CONTENT -->

      
    <?php $this->load->view('admin/footer') ?>
