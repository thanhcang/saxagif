<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Config extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load language
        $this->lang->load('config');
    }
    
    public function index()
    {
        // Check permission
        /*if(!$this->check->is_allowed($this->session->userdata('ses_permision_admin'), 'config_view'))
		{
			show_error($this->lang->line('unallowed_use_permission'));
			die();
		}*/
        if(@file_exists(APPPATH.'config/setting.php') && @class_exists('Setting'))
		{
            $data['exist_file'] = TRUE;
            
            // Edit setting file
            if (is_writeable(APPPATH.'config/setting.php'))
            {
                $data['is_writable'] = TRUE;
                $data['success_edit'] = FALSE;
                if ($this->session->flashdata('ses_success_edit'))
                {
                    $data['success_edit'] = TRUE;
                }
                
                if($this->input->post('isSubmit') && $this->input->post('isSubmit') == 'true')
				{
                    #BEGIN: CHECK PERMISSION
					if(!$this->check->is_allowed($this->session->userdata('ses_permision_admin'), 'config_edit'))
					{
						show_error($this->lang->line('unallowed_use_permission'));
						die();
					}
                    $this->load->helper('file');
                    #BEGIN: Assign value post
                    $config = '<?php'."\n";
                    $config .= "if(!defined('BASEPATH'))exit('No direct script access allowed');"."\n";
                    $config .= '/**'."\n";
                    $config .= ' *Class Setting: Luu tat ca cac cau hinh'."\n";
                    $config .= '**/'."\n";
                    $config .= 'class Setting'."\n";
                    $config .= '{'."\n";
                    #Thong tin website
                    $config .= '#Thong tin website'."\n";
                    $config .= "const settingTitle = '".$this->filter->clear($this->input->post('site_config'))."';"."\n";
                    $config .= "const settingDescr = '".$this->filter->clear($this->input->post('descr_config'))."';"."\n";
                    $config .= "const settingKeyword = '".$this->filter->clear($this->input->post('keyword_config'))."';"."\n";
                    $config .= "const settingEmail_1 = '".$this->filter->clear($this->input->post('email1_config'))."';"."\n";
                    $config .= "const settingEmail_2 = '".$this->filter->clear($this->input->post('email2_config'))."';"."\n";
                    $config .= "const settingAddress_1 = '".$this->filter->clear($this->input->post('address1_config'))."';"."\n";
                    $config .= "const settingAddress_2 = '".$this->filter->clear($this->input->post('address2_config'))."';"."\n";
                    $config .= "const settingPhone = '".$this->filter->clear($this->input->post('phone_config'))."';"."\n";
                    $config .= "const settingMobile = '".$this->filter->clear($this->input->post('mobile_config'))."';"."\n";
                    $config .= "const settingYahoo_1 = '".$this->filter->clear($this->input->post('yahoo1_config'))."';"."\n";
                    $config .= "const settingYahoo_2 = '".$this->filter->clear($this->input->post('yahoo2_config'))."';"."\n";
                    $config .= "const settingSkype_1 = '".$this->filter->clear($this->input->post('skype1_config'))."';"."\n";
                    $config .= "const settingSkype_2 = '".$this->filter->clear($this->input->post('skype2_config'))."';"."\n";
                    #Cau hinh chung
                    $config .= '#Cau hinh chung'."\n";
                    $config .= "const settingTimePost = ".(int)$this->input->post('timepost_config').";"."\n";
                    $config .= "const settingLockAccount = ".(int)$this->input->post('timelock_config').";"."\n";
                    $config .= "const settingTimeSession = ".(int)$this->input->post('timesession_config').";"."\n";
                    $config .= "const settingTimeCache = ".(int)$this->input->post('timecache_config').";"."\n";
                    if($this->input->post('stopsite_config') == '1')
                    {
						$stopsite_config = 1;
                    }
					else
					{
						$stopsite_config = 0;
					}
                    $config .= "const settingStopSite = '".$stopsite_config."';"."\n";
                    if($this->input->post('active_config') == '1')
                    {
                        $active_config = 1;
                    }
                    else
                    {
						$active_config = 0;
                    }
                    $config .= "const settingActiveAccount = '".$active_config."';"."\n";
                    if($this->input->post('stopregis_config') == '1')
                    {
						$stopregis_config = 1;
                    }
                    else
                    {
                        $stopregis_config = 0;
                    }
                    $config .= "const settingStopRegister = '".$stopregis_config."';"."\n";
                    $config .= "const settingExchange = ".(int)$this->input->post('exchange_config').";"."\n";
                    #Hien thi san pham
                    $config .= '#Hien thi san pham'."\n";
                    $config .= "const settingProductNew_Home = ".(int)$this->input->post('pro1_config').";"."\n";
                    $config .= "const settingProductNew_Category = ".(int)$this->input->post('pro2_config').";"."\n";
                    $config .= "const settingProductSaleoff = ".(int)$this->input->post('pro3_config').";"."\n";
                    $config .= "const settingProductNew_Top = ".(int)$this->input->post('pro4_config').";"."\n";
                    $config .= "const settingProductSaleoff_Top = ".(int)$this->input->post('pro5_config').";"."\n";
                    $config .= "const settingProductBuyest_Top = ".(int)$this->input->post('pro6_config').";"."\n";
                    $config .= "const settingProductCategory = ".(int)$this->input->post('pro7_config').";"."\n";
                    #Hien thi shopping
                    $config .= '#Hien thi shopping'."\n";
                    $config .= "const settingShoppingInterest_Home = ".(int)$this->input->post('shopping1_config').";"."\n";
                    $config .= "const settingShoppingNew_Home = ".(int)$this->input->post('shopping2_config').";"."\n";
                    $config .= "const settingShoppingSaleoff_Home = ".(int)$this->input->post('shopping3_config').";"."\n";
                    $config .= "const settingShoppingNew_List = ".(int)$this->input->post('shopping4_config').";"."\n";
                    $config .= "const settingShoppingSaleoff_List = ".(int)$this->input->post('shopping5_config').";"."\n";
                    $config .= "const settingShoppingAdsNew = ".(int)$this->input->post('shopping6_config').";"."\n";
                    $config .= "const settingShoppingProductNew_Top = ".(int)$this->input->post('shopping7_config').";"."\n";
                    $config .= "const settingShoppingAdsNew_Top = ".(int)$this->input->post('shopping8_config').";"."\n";
                    $config .= "const settingShoppingSearch = ".(int)$this->input->post('shopping9_config').";"."\n";
                    #Hien thi tim kiem
                    $config .= '#Hien thi tim kiem'."\n";
                    $config .= "const settingSearchProduct = ".(int)$this->input->post('search1_config').";"."\n";
                    $config .= "const settingSearchAds = ".(int)$this->input->post('search2_config').";"."\n";
                    $config .= "const settingSearchJob = ".(int)$this->input->post('search3_config').";"."\n";
                    $config .= "const settingSearchShop = ".(int)$this->input->post('search4_config').";"."\n";
                    #Cau hinh hien thi khac
                    $config .= '#Cau hinh hien thi khac'."\n";
                    $config .= "const settingOtherAccount = ".(int)$this->input->post('other1_config').";"."\n";
                    $config .= "const settingOtherAdmin = ".(int)$this->input->post('other2_config').";"."\n";
                    $config .= "const settingOtherShowcart = ".(int)$this->input->post('other3_config').";"."\n";
                    $config .= '}';
                    #END Assign value post
                    if(write_file(APPPATH.'config/setting.php', $config))
                    {
                        $this->session->set_flashdata('ses_success_edit', 1);
                    }
                    redirect(base_url().'adminit/system/config', 'location');
                }   
            }
            else
            {
                $data['is_writable'] = false;
                $data['success_edit'] = false;
            }
            $data['site_config'] = Setting::settingTitle;
            $data['descr_config'] = Setting::settingDescr;
            $data['keyword_config'] = Setting::settingKeyword;
            $data['email1_config'] = Setting::settingEmail_1;
            $data['email2_config'] = Setting::settingEmail_2;
            $data['address1_config'] = Setting::settingAddress_1;
            $data['address2_config'] = Setting::settingAddress_2;
            $data['phone_config'] = Setting::settingPhone;
            $data['mobile_config'] = Setting::settingMobile;
            $data['yahoo1_config'] = Setting::settingYahoo_1;
            $data['yahoo2_config'] = Setting::settingYahoo_2;
            $data['skype1_config'] = Setting::settingSkype_1;
            $data['skype2_config'] = Setting::settingSkype_2;
            #Cau hinh chung
            $data['timelock_config'] = Setting::settingLockAccount;
            $data['timesession_config'] = Setting::settingTimeSession;
            $data['timecache_config'] = Setting::settingTimeCache;
            $data['timepost_config'] = Setting::settingTimePost;
            $data['stopsite_config'] = Setting::settingStopSite;
            $data['active_config'] = Setting::settingActiveAccount;
            $data['stopregis_config'] = Setting::settingStopRegister;
            $data['exchange_config'] = Setting::settingExchange;
            #Hien thi san pham
            $data['pro1_config'] = Setting::settingProductNew_Home;
            $data['pro2_config'] = Setting::settingProductNew_Category;
            $data['pro3_config'] = Setting::settingProductSaleoff;
            $data['pro4_config'] = Setting::settingProductNew_Top;
            $data['pro5_config'] = Setting::settingProductSaleoff_Top;
            $data['pro6_config'] = Setting::settingProductBuyest_Top;
            $data['pro7_config'] = Setting::settingProductCategory;
            #Hien thi site shopping
            $data['shopping1_config'] = Setting::settingShoppingInterest_Home;
            $data['shopping2_config'] = Setting::settingShoppingNew_Home;
            $data['shopping3_config'] = Setting::settingShoppingSaleoff_Home;
            $data['shopping4_config'] = Setting::settingShoppingNew_List;
            $data['shopping5_config'] = Setting::settingShoppingSaleoff_List;
            $data['shopping6_config'] = Setting::settingShoppingAdsNew;
            $data['shopping7_config'] = Setting::settingShoppingProductNew_Top;
            $data['shopping8_config'] = Setting::settingShoppingAdsNew_Top;
            $data['shopping9_config'] = Setting::settingShoppingSearch;
			#Hien thi tim kiem
            $data['search1_config'] = Setting::settingSearchProduct;
            $data['search2_config'] = Setting::settingSearchAds;
            $data['search3_config'] = Setting::settingSearchJob;
            $data['search4_config'] = Setting::settingSearchShop;
            #Cau hinh hien thi khac
            $data['other1_config'] = Setting::settingOtherAccount;
            $data['other2_config'] = Setting::settingOtherAdmin;
            $data['other3_config'] = Setting::settingOtherShowcart;
            #END Assign value
        }
        else
		{
			$data['exist_file'] = false;
		}
                //print_r($data['is_writable']);exit;
		#Load view
                $tpl["main_content"] = $this->load->view('config/defaults', $data, TRUE);
                $this->load->view(TEMPLATE, $tpl);
    }
    function info()
	{
        #BEGIN: CHECK PERMISSION
		if(!$this->check->is_allowed($this->session->userdata('ses_permision_admin'), 'config_view'))
		{
			show_error($this->lang->line('unallowed_use_permission'));
			die();
		}
		#END CHECK PERMISSION
		#Load view
		$this->load->view('config/info');
	}
}