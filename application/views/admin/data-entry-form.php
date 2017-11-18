<section class="dashboard_content sheets_paper" style="max-width: 800px">
  <section class="main_dashboard_slidetab">
    <div class="site-map">
      <a href="<?php echo base_url('dashboard') ?>">Dashboard</a>
      <span></span>Penerima IIN
    </div>
    <h2 class="title_content sort-center">Historical Data Entry</h2>


    <form action="">
       <section class="clearfix" style="margin: 0 -21px">
          <!-- APPLICANT DETAIL -->
          <h4 class="title-form-section">Data Pemohon</h4>
          <div class="data-entry-form">    
            <div class="display-flex">
              <label class="input-data" style="flex:2">
                Nama Pemohon
                <input name="mailing_location" type="text" required/>
            </label>
              <label class="input-data">
                Nomor Telepon Pemohon
                <input name="application_date" type="text" required/>
              </label>
              <label class="input-data">
                Tanggal Pengajuan
                <input name="application_date" type="date" required/>
              </label>
            </div>
          </div>


          <!-- INSTANCE DETAIL -->
          <h4 class="title-form-section">Data Perusahaan</h4>   
          <div class="data-entry-form">       
            <label class="input-data">
                Nama Instansi
                <input name="mailing_location" type="text" required/>
            </label>
            <label class="input-data">
                Nama Direktur Utama/Manager/Kepala Divisi Pemohon
                <input name="application_date" type="text" required/>
            </label>
            <div class="display-flex">
              <label class="input-data">
                  Email Instansi
                  <input name="application_date" type="email" required/>
              </label>
              <label class="input-data">
                  Nomor Telepon
                  <input name="application_date" type="text" required/>
              </label>
            </div>
            <label class="input-data">
                Nomor Surat
                <input name="application_date" type="text" required/>
            </label>
            <label class="input-data">
                Lokasi Pengajuan
                <input name="application_date" type="text" required/>
            </label>
          </div>

          <!-- IIN DETAIL -->
          <h4 class="title-form-section">Data IIN</h4>
          <div class="data-entry-form">
            
            <div class="display-flex">
              <label class="input-data">
                Nomor IIN
                <input name="mailing_number" type="text" required/>
              </label>
              <label class="input-data">
                Tanggal Pengesahan
                <input name="application_date" type="date" required/>
              </label>
              <label class="input-data">
                Tanggal Kadaluarsa
                <input name="application_date" type="date" required/>
              </label>
            </div>
          </div>
          
        </section>

        <div class="clearfix">
          <button type="submit" style="float: right; margin: 20px">Masukan Data</button>  
        </div>
        
    </form>
  </section>
</section>




