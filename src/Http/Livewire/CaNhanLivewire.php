<?php

namespace Totaa\TotaaPoster\Http\Livewire;

use Auth;
use Livewire\Component;
use Totaa\TotaaTeam\Models\Team;
use Illuminate\Support\Facades\Cache;
use Totaa\TotaaDonvi\Models\TotaaTinh;
use Totaa\TotaaDonvi\Models\TotaaHuyen;
use Totaa\TotaaPoster\Models\Poster\Poster_Name;
use Totaa\TotaaPoster\Models\Poster\Poster_BeMat;
use Totaa\TotaaPoster\Models\Poster\Poster_HinhThuc;
use Totaa\TotaaPoster\Models\Poster\Poster_MucThuong;
use Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_PhanLoai;
use Livewire\WithFileUploads;

class CaNhanLivewire extends Component
{
    use WithFileUploads;

    /**
    * Các biến sử dụng trong Component
    *
    * @var mixed
    */
   public $diadiem_id, $team_id, $belongto_mnv, $loaidiadiem_id, $tendiadiem, $chudiadiem, $phone, $tinh_id, $huyen_id, $xa_id, $diachi, $thongtinkhac, $poster_name_id, $poster_hinhthuc_id, $poster_bemat_id, $ngang, $doc, $vitridan, $mucthuong_id, $hinhanh1, $hinhanh2, $hinhanh3, $ghichu;
   public $bfo_info, $modal_title, $toastr_message, $add_diemdan_step, $team_arrays = [], $tdv_arrays = [], $diadiem_phanloai_arrays = [], $tinh_arrays = [], $huyen_arrays = [], $xa_arrays = [], $poster_name_arrays = [], $poster_hinhthuc_arrays = [], $poster_bemat_arrays =[], $poster_mucthuong_arrays = [];

    /**
     * Cho phép cập nhật updateMode
     *
     * @var bool
     */
    public $updateMode = false;
    public $editStatus = false;

    /**
     * Các biển sự kiện
     *
     * @var array
     */
    protected $listeners = ['add_diemdan', ];

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
        $this->add_diemdan_step = 2;

        $this->dispatchBrowserEvent('show_modal', "#add_edit_modal");
    }

    /**
     * next_step method
     *
     * @return void
     */
    public function next_step($step)
    {
        if (Auth::user()->bfo_info->hasAnyRole("khaosat-poster")) {
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
     * back_step method
     *
     * @return void
     */
    public function save_diemdan()
    {
        if ($this->bfo_info->cannot("add-poster")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->validate();

        dd($this->hinhanh1);
    }

}
