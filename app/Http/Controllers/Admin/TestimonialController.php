<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Http\Requests\Admin\TestimonialUpdateRequest;
use App\Models\EmailTemplate;
use App\Traits\StatusTrait;

class TestimonialController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.testimonial.index', [
            'testimonials' => Testimonial::query()->select(['id', 'name', 'description', 'image', 'designation', 'rating', 'created_at', 'status'])->latest()->get()
        ]);
    }
    public function create(): View
    {
        return view('admin.testimonial.create');
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $testimonial = Testimonial::create($request->safe()->except('image'));
        if ($request->hasFile('image')) {
            $testimonial->storeImage('image', 'testimonial-images', $request->file('image'));
        }
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Created Successfully!');
    }

    public function show(Testimonial $testimonial): View
    {
        return view('admin.testimonial.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->safe()->except('image');
        if ($request->input('image_removed') == 'true') {
            $testimonial->deleteImage('image', 'testimonial-images');
            $data['image'] = null;
        }

        $testimonial->update($data);

        if ($request->hasFile('image')) {
            $testimonial->updateImage('image', 'testimonial-images', $request->file('image'));
        }

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Updated Successfully!');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->image) {
            $testimonial->deleteImage('image', 'testimonial-images');
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('error', 'Testimonial Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Testimonial', $request->id, $request->status);
    }
    public function showTestimonial(Testimonial $testimonial): View
    {
        return view('admin.testimonial.show_notification', compact('testimonial'));
    }

    public function testimonialNotification(Testimonial $testimonial)
    {
        return view('admin.testimonial.notification', [
            'testimonial' => $testimonial,
            'templates' => EmailTemplate::pluck('name', 'id'),
        ]);
    }
}
