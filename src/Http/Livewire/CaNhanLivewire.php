<?php

namespace Totaa\TotaaPoster\Http\Livewire;

use Auth;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Totaa\TotaaTeam\Models\Team;
use Illuminate\Support\Facades\Cache;
use Totaa\TotaaDonvi\Models\TotaaTinh;
use Totaa\TotaaDonvi\Models\TotaaHuyen;
use Totaa\TotaaDonvi\Models\TotaaXa;
use Illuminate\Support\Facades\Validator;
use Totaa\TotaaPoster\Models\Poster\Poster_List;
use Totaa\TotaaPoster\Models\Poster\Poster_Name;
use Totaa\TotaaPoster\Models\Poster\Poster_BeMat;
use Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_List;
use Totaa\TotaaPoster\Models\Poster\Poster_ChiTiet;
use Totaa\TotaaPoster\Models\Poster\Poster_HinhThuc;
use Totaa\TotaaPoster\Models\Poster\Poster_MucThuong;
use Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_PhanLoai;
use Totaa\TotaaFileUpload\Traits\TotaaFileUploadTraits;
use Totaa\TotaaPoster\Models\Poster\Poster_ChiTiet_HinhAnh;

class CaNhanLivewire extends Component
{
    use WithFileUploads;
    use TotaaFileUploadTraits;

    /**
    * Các biến sử dụng trong Component
    *
    * @var mixed
    */
   public $diadiem_id, $team_id, $belongto_mnv, $loaidiadiem_id, $tendiadiem, $chudiadiem, $phone, $tinh_id, $huyen_id, $xa_id, $diachi, $thongtinkhac, $poster_name_id, $poster_hinhthuc_id, $poster_bemat_id, $ngang, $doc, $vitridan, $mucthuong_id, $hinhanh1, $hinhanh2, $hinhanh3, $ghichu, $poster_id;
   public $bfo_info, $modal_title, $toastr_message, $add_diemdan_step, $team_arrays = [], $tdv_arrays = [], $diadiem_phanloai_arrays = [], $tinh_arrays = [], $huyen_arrays = [], $xa_arrays = [], $poster_name_arrays = [], $poster_hinhthuc_arrays = [], $poster_bemat_arrays =[], $poster_mucthuong_arrays = [], $hinhanh_arrays = [];
   public $diadiem, $poster, $poster_chitiet, $poster_chitiets;

    /**
     * Cho phép cập nhật updateMode
     *
     * @var bool
     */
    public $updateMode = false;
    public $editStatus = false;
    public $editDiaDiemID = false;
    public $editPosterID = false;
    public $editPosterChiTietID = false;
    public $deletePosterChiTietID = false;

    /**
     * Các biển sự kiện
     *
     * @var array
     */
    protected $listeners = ['add_diemdan', 'save_diemdan', 'Update_TotaaFileUploadStep', 'TotaaFileUploadSubmit', 'delete_poster_confirm', 'add_poster_modal', 'add_poster', 'view_poster', ];

        /**
     * Validation rules
     *
     * @var array
     */
    protected function rules() {
        if (Auth::user()->bfo_info->hasAnyRole("khaosat-poster")) {
            $custom_rule = "required";
        } else {
            $custom_rule = "nullable";
        }

        return [
            'team_id' => $custom_rule.'|exists:teams,id',
            'belongto_mnv' => $custom_rule.'|exists:bfo_infos,mnv',
            'loaidiadiem_id' => 'required|exists:diadiem_phanloais,id',
            'tendiadiem' => 'required',
            'chudiadiem' => 'required',
            'phone' => 'required|numeric',
            'tinh_id' => 'required|exists:list_tinhs,id',
            'huyen_id' => 'required|exists:list_huyens,id',
            'xa_id' => 'required|exists:list_xas,id',
            'diachi' => 'required',
            'thongtinkhac' => 'nullable',
            'poster_name_id' => 'required|exists:poster_names,id',
            'poster_hinhthuc_id' => 'required|exists:poster_hinhthucs,id',
            'poster_bemat_id' => 'required|exists:poster_bemats,id',
            'ngang' => 'required|numeric|integer',
            'doc' => 'required|numeric|integer',
            'vitridan' => 'required',
            'mucthuong_id' => 'required|exists:poster_mucthuongs,id',
            'hinhanh1' => 'required|file|image',
            'hinhanh2' => 'required|file|image',
            'hinhanh3' => 'nullable|file|image',
            'ghichu' => 'nullable',
        ];
    }

    /**
     * Custom attributes
     *
     * @var array
     */
    protected $validationAttributes = [
        'belongto_mnv' => 'trình dược viên',
        'team_id' => 'nhóm',
        'loaidiadiem_id' => 'loại địa điểm',
        'tendiadiem' => 'tên địa điểm',
        'chudiadiem' => 'chủ địa điểm',
        'tinh_id' => 'tỉnh',
        'huyen_id' => 'huyện',
        'xa_id' => 'xã',
        'diachi' => 'địa chỉ',
        'thongtinkhac' => 'thông tin khác',
        'poster_name_id' => 'tên poster',
        'poster_hinhthuc_id' => 'hình thức poster',
        'poster_bemat_id' => 'bề mặt',
        'ngang' => 'ngang',
        'doc' => 'dọc',
        'vitridan' => 'vị trí dán',
        'mucthuong_id' => 'mức thưởng',
        'hinhanh1' => 'hình ảnh 1',
        'hinhanh2' => 'hình ảnh 2',
        'hinhanh3' => 'hình ảnh 3',
        'ghichu' => 'ghi chú',
    ];

    /**
     * render view
     *
     * @return void
     */
    public function render()
    {
        return view('totaa-poster::livewire.canhan.canhan-livewire');
    }

    /**
     * mount data
     *
     * @return void
     */
    public function mount()
    {
        $this->bfo_info = Auth::user()->bfo_info;
        $this->team_arrays = Team::where("active", true)->where("kenh_kd_id", 2)->select("id", "name")->get()->toArray();
        $this->diadiem_phanloai_arrays = DiaDiem_PhanLoai::where("active", true)->select("id", "name")->get()->toArray();
        $this->tinh_arrays = TotaaTinh::where("active", true)->where("poster", true)->orderBy('order', 'asc')->orderBy('name', 'asc')->select("id", "level", "name")->get()->toArray();
        $this->poster_name_arrays = Poster_Name::where("active", true)->select("id", "name")->get()->toArray();
        $this->poster_hinhthuc_arrays = Poster_HinhThuc::where("active", true)->select("id", "name")->get()->toArray();
        $this->poster_bemat_arrays = Poster_BeMat::where("active", true)->select("id", "name")->get()->toArray();
        $this->poster_mucthuong_arrays = Poster_MucThuong::where("active", true)->select("id", "mucthuong")->get()->toArray();
    }

    /**
     * On updated action
     *
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedTeamId()
    {
        if (!!$this->team_id) {
            $this->belongto_mnv = NULL;
            $this->tdv_arrays = Team::find($this->team_id)->team_members()->select("mnv", "full_name")->get()->toArray();
        }
    }

    public function updatedTinhId()
    {
        if (!!$this->tinh_id) {
            $this->huyen_id = NULL;
            $this->xa_id = NULL;
            $this->huyen_arrays = TotaaTinh::find($this->tinh_id)->huyens()->orderBy('order', 'asc')->orderBy('name', 'asc')->select("id", "level", "name")->get()->toArray();
        }
    }

    public function updatedHuyenId()
    {
        if (!!$this->huyen_id) {
            $this->xa_id = NULL;
            $this->xa_arrays = TotaaHuyen::find($this->huyen_id)->xas()->orderBy('order', 'asc')->orderBy('name', 'asc')->select("id", "level", "name")->get()->toArray();
        }
    }

    /**
     * cancel
     *
     * @return void
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->editStatus = false;
        $this->resetValidation();
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('unblockUI');
        $this->dispatchBrowserEvent('hide_modal');
    }

    /**
     * add_diemdan method
     *
     * @return void
     */
    public function add_diemdan()
    {
        if ($this->bfo_info->cannot("add-poster")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->modal_title = "Thêm điểm dán Poster mới";
        $this->toastr_message = "Thêm điểm dán thành công";
        $this->editStatus = false;
        $this->updateMode = false;
        $this->add_diemdan_step = 1;

        $this->dispatchBrowserEvent('unblockUI');

        $this->dispatchBrowserEvent('show_modal', "#add_edit_modal");
    }

    /**
     * next_step method
     *
     * @return void
     */
    public function next_step($step)
    {
        if ($this->bfo_info->hasAnyRole("khaosat-poster")) {
            $custom_rule = "required";
        } else {
            $custom_rule = "nullable";
        }

        $this->validate([
            'team_id' => $custom_rule.'|exists:teams,id',
            'belongto_mnv' => $custom_rule.'|exists:bfo_infos,mnv',
            'loaidiadiem_id' => 'required|exists:diadiem_phanloais,id',
            'tendiadiem' => 'required',
            'chudiadiem' => 'required',
            'phone' => 'required|numeric',
            'tinh_id' => 'required|exists:list_tinhs,id',
            'huyen_id' => 'required|exists:list_huyens,id',
            'xa_id' => 'required|exists:list_xas,id',
            'diachi' => 'required',
            'thongtinkhac' => 'nullable',
        ]);

        $this->add_diemdan_step = $step;
    }

    /**
     * back_step method
     *
     * @return void
     */
    public function back_step($step)
    {
        $this->add_diemdan_step = $step;
    }

    /**
     * save_diemdan method
     *
     * @return void
     */
    public function save_diemdan()
    {
        if ($this->bfo_info->cannot("add-poster")) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->dispatchBrowserEvent('unblockUI');
        $this->validate();
        $this->dispatchBrowserEvent('blockUI');

        //Upload ảnh vào thư viện
        $tt_timestamp = Carbon::now()->timestamp;
        $path = "Truyền thông/Khảo sát Poster/Poster ".Poster_Name::find($this->poster_name_id)->name."/".TotaaTinh::find($this->tinh_id)->name;
        $this->hinhanh_arrays = [];
        $this->hinhanh_arrays[] = $this->save_to_drive($this->hinhanh1, $path, $this->bfo_info->mnv."_".$this->xa_id."_".$tt_timestamp."_1.".$this->hinhanh1->getClientOriginalExtension());
        $this->hinhanh_arrays[] = $this->save_to_drive($this->hinhanh2, $path, $this->bfo_info->mnv."_".$this->xa_id."_".$tt_timestamp."_2.".$this->hinhanh2->getClientOriginalExtension());
        if (!!$this->hinhanh3) {
            $this->hinhanh_arrays[] = $this->save_to_drive($this->hinhanh3, $path, $this->bfo_info->mnv."_".$this->xa_id."_".$tt_timestamp."_3.".$this->hinhanh3->getClientOriginalExtension());
        }

        try {
            //Check và tạo địa điểm
            $this->diadiem = DiaDiem_List::updateOrCreate(
                [
                    'phone' => $this->phone,
                    'loaidiadiem_id' => $this->loaidiadiem_id,
                    'xa_id' => $this->xa_id,
                ],
                [
                    'tendiadiem' => $this->tendiadiem,
                    'chudiadiem' => $this->chudiadiem,
                    'diachi' => $this->diachi,
                    'thongtinkhac' => $this->thongtinkhac,
                    'belongto_mnv' => !!$this->belongto_mnv ? $this->belongto_mnv : $this->bfo_info->mnv,
                    'created_by_mnv' => $this->bfo_info->mnv,
                    'active' => true
                ]
            );

            //Check và tạo Poster
            $this->poster = $this->diadiem->posters()->where("poster_name_id", $this->poster_name_id)->first();

            //Nếu như điểm dán đã được duyệt thì không thể thêm poster loại này vào nữa
            if (!!$this->poster) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Đã tồn tại Poster ".Poster_Name::find($this->poster_name_id)->name." tại địa điểm ".$this->tendiadiem." vui lòng sử dụng chức năng thêm Poster"]);
                return null;
            }

            $this->poster = Poster_List::updateOrCreate(
                [
                    'diadiem_id' => $this->diadiem->id,
                    'poster_name_id' => $this->poster_name_id,
                ],
                [
                    'mucthuong_id' => $this->mucthuong_id,
                    'trangthai_id' => 5,
                    'belongto_mnv' => !!$this->belongto_mnv ? $this->belongto_mnv : $this->bfo_info->mnv,
                    'created_by_mnv' => $this->bfo_info->mnv,
                    'active' => true
                ]
            );

            if (!!!$this->poster->poster_code) {
                $this->poster->update([
                    'poster_code' => Poster_Name::find($this->poster_name_id)->name[0].sprintf("%06d",$this->poster->id),
                ]);
            }

            //Tạo chi tiết poster
            $this->poster_chitiet = Poster_ChiTiet::create(
                [
                    'poster_id' => $this->poster->id,
                    'poster_hinhthuc_id' => $this->poster_hinhthuc_id,
                    'poster_bemat_id' => $this->poster_bemat_id,
                    'ngang' => $this->ngang,
                    'doc' => $this->doc,
                    'vitridan' => $this->vitridan,
                    'ghichu' => $this->ghichu,
                    'belongto_mnv' => !!$this->belongto_mnv ? $this->belongto_mnv : $this->bfo_info->mnv,
                    'created_by_mnv' => $this->bfo_info->mnv,
                    'active' => true
                ]
            );

            //Gắn hình ảnh khảo sát vào Poster
            foreach ($this->hinhanh_arrays as $key => $value) {
                Poster_ChiTiet_HinhAnh::create(
                    [
                        'poster_chitiet_id' => $this->poster_chitiet->id,
                        'totaa_file_id' => $value,
                        'belongto_mnv' => !!$this->belongto_mnv ? $this->belongto_mnv : $this->bfo_info->mnv,
                        'created_by_mnv' => $this->bfo_info->mnv,
                        'active' => true
                    ]
                );
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        } catch (\Exception $e2) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => $e2->getMessage()]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $toastr_message = $this->toastr_message;
        $this->cancel();
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => $toastr_message]);
    }

    /**
     * Hiện thị cửa sổ xác nhận xóa
     *
     * @return void
     */
    public function delete_poster_confirm($id)
    {
        if ($this->bfo_info->cannot("delete-poster")) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            $this->cancel();
            return null;
        }

        $this->poster_id = $id;
        $this->poster = Poster_List::find($this->poster_id);

        if ($this->poster->trangthai_id != 5) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể xóa"]);
            $this->cancel();
            return null;
        }

        $this->modal_title = "Xóa Poster";
        $this->toastr_message = "Xóa Poster thành công";

        $this->dispatchBrowserEvent('unblockUI');
        $this->dispatchBrowserEvent('show_modal', "#delete_modal");
    }

    /**
     * Tiến hành xóa thôi
     *
     * @return void
     */
    public function delete_poster()
    {
        if ($this->bfo_info->cannot("delete-poster")) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            $this->cancel();
            return null;
        }

        if ($this->poster->trangthai_id != 5) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể xóa"]);
            $this->cancel();
            return null;
        }

        try {
            $this->diadiem = $this->poster->diadiem;
            $this->poster->poster_chitiets()->delete();
            $this->poster->delete();
            if (!!!$this->diadiem->posters->count()) {
                $this->diadiem->delete();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        } catch (\Exception $e2) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => $e2->getMessage()]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $toastr_message = $this->toastr_message;
        $this->cancel();
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => $toastr_message]);
    }

    /**
     * Hiện thị cửa sổ thêm poster
     *
     * @return void
     */
    public function add_poster_modal($id)
    {
        //dd(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName());
        if ($this->bfo_info->cannot("add-poster")) {
            $this->cancel();
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->poster_id = $id;
        $this->poster = Poster_List::find($this->poster_id);

        if ($this->poster->trangthai_id != 5) {
            $this->cancel();
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể thêm"]);
            return null;
        }

        $this->diadiem = $this->poster->diadiem;

        $this->modal_title = "Thêm Poster";
        $this->toastr_message = "Thêm Poster thành công";

        $this->editStatus = true;
        $this->updateMode = true;

        $this->dispatchBrowserEvent('unblockUI');
        $this->dispatchBrowserEvent('show_modal', "#add_poster_modal");
    }

    /**
     * Tiến hành thêm thôi nào
     *
     * @return void
     */
    public function add_poster()
    {
        if ($this->bfo_info->cannot("add-poster")) {
            $this->cancel();
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        if ($this->poster->trangthai_id != 5) {
            $this->cancel();
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể thêm"]);
            return null;
        }

        if ($this->bfo_info->hasAnyRole("khaosat-poster")) {
            $custom_rule = "required";
        } else {
            $custom_rule = "nullable";
        }

        $this->dispatchBrowserEvent('unblockUI');
        $this->validate([
            'poster_hinhthuc_id' => 'required|exists:poster_hinhthucs,id',
            'poster_bemat_id' => 'required|exists:poster_bemats,id',
            'ngang' => 'required|numeric|integer',
            'doc' => 'required|numeric|integer',
            'vitridan' => 'required',
            'hinhanh1' => 'required|file|image',
            'hinhanh2' => 'required|file|image',
            'hinhanh3' => 'nullable|file|image',
            'ghichu' => 'nullable',
            'team_id' => $custom_rule.'|exists:teams,id',
            'belongto_mnv' => $custom_rule.'|exists:bfo_infos,mnv',
        ]);
        $this->dispatchBrowserEvent('blockUI');

        //Upload ảnh vào thư viện
        $tt_timestamp = Carbon::now()->timestamp;
        $path = "Truyền thông/Khảo sát Poster/Poster ".Poster_Name::find($this->poster->poster_name_id)->name."/".TotaaXa::find($this->diadiem->xa_id)->huyen->tinh->name;
        $this->hinhanh_arrays = [];
        $this->hinhanh_arrays[] = $this->save_to_drive($this->hinhanh1, $path, $this->bfo_info->mnv."_".$this->diadiem->xa_id."_".$tt_timestamp."_1.".$this->hinhanh1->getClientOriginalExtension());
        $this->hinhanh_arrays[] = $this->save_to_drive($this->hinhanh2, $path, $this->bfo_info->mnv."_".$this->diadiem->xa_id."_".$tt_timestamp."_2.".$this->hinhanh2->getClientOriginalExtension());
        if (!!$this->hinhanh3) {
            $this->hinhanh_arrays[] = $this->save_to_drive($this->hinhanh3, $path, $this->bfo_info->mnv."_".$this->diadiem->xa_id."_".$tt_timestamp."_3.".$this->hinhanh3->getClientOriginalExtension());
        }

        try {
            //Tạo chi tiết poster
            $this->poster_chitiet = Poster_ChiTiet::create(
                [
                    'poster_id' => $this->poster->id,
                    'poster_hinhthuc_id' => $this->poster_hinhthuc_id,
                    'poster_bemat_id' => $this->poster_bemat_id,
                    'ngang' => $this->ngang,
                    'doc' => $this->doc,
                    'vitridan' => $this->vitridan,
                    'ghichu' => $this->ghichu,
                    'belongto_mnv' => !!$this->belongto_mnv ? $this->belongto_mnv : $this->bfo_info->mnv,
                    'created_by_mnv' => $this->bfo_info->mnv,
                    'active' => true
                ]
            );

            //Gắn hình ảnh khảo sát vào Poster
            foreach ($this->hinhanh_arrays as $key => $value) {
                Poster_ChiTiet_HinhAnh::create(
                    [
                        'poster_chitiet_id' => $this->poster_chitiet->id,
                        'totaa_file_id' => $value,
                        'belongto_mnv' => !!$this->belongto_mnv ? $this->belongto_mnv : $this->bfo_info->mnv,
                        'created_by_mnv' => $this->bfo_info->mnv,
                        'active' => true
                    ]
                );
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        } catch (\Exception $e2) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => $e2->getMessage()]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $toastr_message = $this->toastr_message;
        $this->cancel();
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => $toastr_message]);
    }

    /**
     * Hiện thị cửa sổ xem chi tiết poster
     *
     * @return void
     */
    public function view_poster($id)
    {
        if ($this->bfo_info->cannot("view-poster")) {
            $this->cancel();
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->poster_id = $id;
        $this->poster = Poster_List::find($this->poster_id);

        $this->diadiem = $this->poster->diadiem;
        $this->poster_chitiets = $this->poster->poster_chitiets;

        $this->dispatchBrowserEvent('unblockUI');
        $this->dispatchBrowserEvent('show_modal', "#view_poster_modal");
    }

    /**
     * Chỉnh sửa địa điểm
     *
     * @return void
     */
    public function edit_diadiem($id)
    {
        if (!!$id) {
            if ($this->bfo_info->cannot("edit-poster")) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
                return null;
            }

            if ($this->poster->trangthai_id != 5) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể chỉnh sửa"]);
                return null;
            }

            $this->dispatchBrowserEvent('unblockUI');
            $this->editDiaDiemID = $id;
            $this->editStatus = true;
            $this->loaidiadiem_id = $this->diadiem->loaidiadiem_id;
            $this->tendiadiem = $this->diadiem->tendiadiem;
            $this->chudiadiem = $this->diadiem->chudiadiem;
            $this->phone = $this->diadiem->phone;
            $this->diachi = $this->diadiem->diachi;
            $this->thongtinkhac = $this->diadiem->thongtinkhac;
            $this->xa_id = $this->diadiem->xa_id;
            $this->xa = $this->diadiem->xa;
            $this->huyen = $this->xa->huyen;
            $this->huyen_id = $this->huyen->id;
            $this->tinh = $this->huyen->tinh;
            $this->tinh_id = $this->tinh->id;

            $this->huyen_arrays = TotaaTinh::find($this->tinh_id)->huyens()->orderBy('order', 'asc')->orderBy('name', 'asc')->select("id", "level", "name")->get()->toArray();
            $this->xa_arrays = TotaaHuyen::find($this->huyen_id)->xas()->orderBy('order', 'asc')->orderBy('name', 'asc')->select("id", "level", "name")->get()->toArray();

            $this->dispatchBrowserEvent('select2_update');
        } else {
            $this->dispatchBrowserEvent('unblockUI');
            $this->editDiaDiemID = false;
        }
    }

   /**
     * Chỉnh sửa địa điểm
     *
     * @return void
     */
    public function save_edit_diadiem()
    {
        if ($this->bfo_info->cannot("edit-poster")) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        if ($this->poster->trangthai_id != 5) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể chỉnh sửa"]);
            return null;
        }

        $this->dispatchBrowserEvent('unblockUI');
        $validateData = $this->validate([
            'loaidiadiem_id' => 'required|exists:diadiem_phanloais,id',
            'tendiadiem' => 'required',
            'chudiadiem' => 'required',
            'phone' => 'required|numeric',
            'tinh_id' => 'required|exists:list_tinhs,id',
            'huyen_id' => 'required|exists:list_huyens,id',
            'xa_id' => 'required|exists:list_xas,id',
            'diachi' => 'required',
            'thongtinkhac' => 'nullable',
        ]);
        $this->dispatchBrowserEvent('blockUI');

        if(!!DiaDiem_List::where("id", "<>",$this->diadiem->id)->where("loaidiadiem_id", $this->loaidiadiem_id)->where("phone", $this->phone)->where("xa_id", $this->xa_id)->count()) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Đã tồn tại Địa điểm với các thông tin này"]);
            return null;
        }

        try {
            $idd = $this->diadiem->id;
            $this->diadiem->update($validateData);
            $this->diadiem = DiaDiem_List::find($idd);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        } catch (\Exception $e2) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => $e2->getMessage()]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $this->editDiaDiemID = false;
        $this->dispatchBrowserEvent('unblockUI');
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => "Chỉnh sửa địa điểm thành công thành công"]);
    }

    /**
     * Chỉnh sửa Poster
     *
     * @return void
     */
    public function edit_poster($id)
    {
        if (!!$id) {
            if ($this->bfo_info->cannot("edit-poster")) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
                return null;
            }

            if ($this->poster->trangthai_id != 5) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể chỉnh sửa"]);
                return null;
            }

            $this->dispatchBrowserEvent('unblockUI');
            $this->editPosterID = $id;
            $this->editStatus = true;
            $this->poster_name_id = $this->poster->poster_name_id;
            $this->mucthuong_id = $this->poster->mucthuong_id;

            $this->dispatchBrowserEvent('select2_update');
        } else {
            $this->dispatchBrowserEvent('unblockUI');
            $this->editPosterID = false;
        }
    }


   /**
     * Chỉnh sửa Poster
     *
     * @return void
     */
    public function save_edit_poster()
    {
        if ($this->bfo_info->cannot("edit-poster")) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        if ($this->poster->trangthai_id != 5) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể chỉnh sửa"]);
            return null;
        }

        $this->dispatchBrowserEvent('unblockUI');
        $validateData = $this->validate([
            'poster_name_id' => 'required|exists:poster_names,id',
            'mucthuong_id' => 'required|exists:poster_mucthuongs,id',
        ]);
        $this->dispatchBrowserEvent('blockUI');

        if(!!Poster_List::where("id", "<>",$this->poster->id)->where("poster_name_id", $this->poster_name_id)->where("diadiem_id", $this->poster->diadiem_id)->count()) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Đã tồn tại Poster ".Poster_Name::find($this->poster_name_id)->name." tại địa điểm này"]);
            return null;
        }

        try {
            $idd = $this->poster->id;
            $this->poster->update($validateData);
            $this->poster = Poster_List::find($idd);
            $this->poster->update([
                'poster_code' => Poster_Name::find($this->poster_name_id)->name[0].sprintf("%06d",$this->poster->id),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        } catch (\Exception $e2) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => $e2->getMessage()]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $this->editPosterID = false;
        $this->dispatchBrowserEvent('unblockUI');
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => "Chỉnh sửa Poster thành công thành công"]);
    }

    /**
     * Chỉnh sửa Thông số Poster
     *
     * @return void
     */
    public function edit_poster_chitiet($id)
    {
        if (!!$id) {
            if ($this->bfo_info->cannot("edit-poster")) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
                return null;
            }

            if ($this->poster->trangthai_id != 5) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể chỉnh sửa"]);
                return null;
            }

            $this->dispatchBrowserEvent('unblockUI');
            $this->editPosterChiTietID = $id;
            $this->editStatus = true;

            $this->poster_chitiet = Poster_ChiTiet::find($this->editPosterChiTietID);

            $this->poster_hinhthuc_id = $this->poster_chitiet->poster_hinhthuc_id;
            $this->poster_bemat_id = $this->poster_chitiet->poster_bemat_id;
            $this->ngang = $this->poster_chitiet->ngang;
            $this->doc = $this->poster_chitiet->doc;
            $this->vitridan = $this->poster_chitiet->vitridan;
            $this->ghichu = $this->poster_chitiet->ghichu;

            $this->dispatchBrowserEvent('select2_update');
        } else {
            $this->dispatchBrowserEvent('unblockUI');
            $this->editPosterChiTietID = false;
        }
    }

   /**
     * Chỉnh sửa Thông số Poster
     *
     * @return void
     */
    public function save_edit_poster_chitiet()
    {
        if ($this->bfo_info->cannot("edit-poster")) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        if ($this->poster->trangthai_id != 5) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể chỉnh sửa"]);
            return null;
        }

        $this->dispatchBrowserEvent('unblockUI');
        $validateData = $this->validate([
            'poster_hinhthuc_id' => 'required|exists:poster_hinhthucs,id',
            'poster_bemat_id' => 'required|exists:poster_bemats,id',
            'ngang' => 'required|numeric|integer',
            'doc' => 'required|numeric|integer',
            'vitridan' => 'required',
            'ghichu' => 'nullable',
        ]);
        $this->dispatchBrowserEvent('blockUI');

        try {
            $idd = $this->poster_chitiet->id;
            $this->poster_chitiet->update($validateData);
            $this->poster_chitiet = Poster_ChiTiet::find($idd);
            $this->poster_chitiets = $this->poster_chitiet->poster->poster_chitiets;
        } catch (\Illuminate\Database\QueryException $e) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        } catch (\Exception $e2) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => $e2->getMessage()]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $this->editPosterChiTietID = false;
        $this->dispatchBrowserEvent('unblockUI');
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => "Chỉnh sửa Poster thành công thành công"]);
    }

    /**
     * Xóa Thông số Poster
     *
     * @return void
     */
    public function delete_poster_chitiet($id)
    {
        if (!!$id) {
            if ($this->bfo_info->cannot("delete-poster")) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
                return null;
            }

            if ($this->poster->trangthai_id != 5) {
                $this->dispatchBrowserEvent('unblockUI');
                $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể xóa"]);
                return null;
            }

            $this->dispatchBrowserEvent('unblockUI');
            $this->deletePosterChiTietID = $id;
            $this->editStatus = true;
            $this->poster_chitiet = Poster_ChiTiet::find($this->deletePosterChiTietID);
        } else {
            $this->dispatchBrowserEvent('unblockUI');
            $this->deletePosterChiTietID = false;
        }
    }

   /**
     * Chỉnh sửa Thông số Poster
     *
     * @return void
     */
    public function do_delete_poster_chitiet()
    {
        if ($this->bfo_info->cannot("delete-poster")) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        if ($this->poster->trangthai_id != 5) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Poster này đã được duyệt, không thể xóa"]);
            return null;
        }

        try {
            $this->poster = $this->poster_chitiet->poster;
            $this->poster_chitiet->delete();
            $this->diadiem = $this->poster->diadiem;
            $this->poster_chitiets = $this->poster->poster_chitiets;

            if (!!!$this->poster->poster_chitiets->count()) {
                $this->poster->delete();

                $this->dispatchBrowserEvent('hide_modal');

                if (!!!$this->diadiem->posters->count()) {
                    $this->diadiem->delete();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        } catch (\Exception $e2) {
            $this->dispatchBrowserEvent('unblockUI');
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => $e2->getMessage()]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $this->deletePosterChiTietID = false;
        $this->dispatchBrowserEvent('unblockUI');
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => "Xóa Poster thành công thành công"]);
    }
}
