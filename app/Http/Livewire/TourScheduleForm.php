<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use App\Models\Tour;
use App\Models\TourSchedule;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class TourScheduleForm extends Component
{
    /**
     * @var Tour
     */
    public $tour;

    /**
     * @var TourSchedule
     */
    public $schedule;

    /**
     * @var Currency[]
     */
    public $currencies;

    public function mount(TourSchedule $schedule, Tour $tour): void
    {
        $this->schedule = $schedule;
        $this->tour = $tour;
        $this->currencies = Currency::toSelectBox('iso', 'iso');
    }

    public function updated()
    {
        $this->emitUp('changeSchedule', $this->schedule);
    }

    protected $rules = [
        'schedule.start_date' => 'required|date',
        'schedule.end_date' => 'required|date',
        'schedule.price' => 'required|numeric',
        'schedule.commission' => 'nullable|numeric',
        'schedule.currency' => 'nullable|string',
        'schedule.places' => 'numeric|nullable',
    ];

    public function save()
    {
        $this->validate();

        $isUpdate = $this->schedule->id > 0;
        $this->schedule->tour_id = $this->tour->id;
        if (empty($this->schedule->currency)) {
            $this->schedule->currency = 'UAH';
        }
        if (empty($this->schedule->commission)) {
            $this->schedule->commission = 0;
        }
        $this->schedule->save();

        $this->schedule = new TourSchedule();
        $this->schedule->tour_id = $this->tour->id;


        session()->flash('success', $isUpdate ? 'Record updated.' : 'Record created.');

        $this->emitUp('recordSaved');

    }


    public function cancel()
    {
        $this->emitUp('recordSaved');
    }

    public function render()
    {
        return view('admin.tour-schedule.includes.form');
    }
}
