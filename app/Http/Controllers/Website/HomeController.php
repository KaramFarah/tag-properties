<?php

namespace App\Http\Controllers\Website;

use App\Models\User;

use App\Models\AuditLog;
use App\Rules\ReCaptchaV3;

use App\Models\Dashboard\Tag;
use App\Models\Dashboard\Blog;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Unit;
use App\Helpers\DashboardHelper;
use App\Models\Dashboard\Project;
use App\Notifications\SendContact;
use App\Models\Dashboard\Developer;

use Illuminate\Support\Facades\Notification;

class HomeController extends WebsiteController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return redirect()->route('login');
        $developers = Developer::orderBy('order')->orderBy('name')->get();
        $blogs = Blog::orderBy('publish_date', 'DESC')->orderBy('title')->limit(3)->get();
        $units = Unit::latest()->limit(5)->where('featuered' , 1)->where('published' , 1)->get();
        $unitsCount = Unit::where('published' , 1)->count();

        $projectsCount = Project::all()->count();

        $propertyTypes = (new Unit)->propertyTypes;
        $propertyPurposes = (new Unit)->propertyPurposes;

        $propertyTypeIcons = (new Unit)->propertyTypeIcons;

        $features = Tag::where('type', 'features')->orderBy('name')->get();
        // $features = Tag::where('type', 'features')->pluck('name', 'id')->all();

        $testimonies = [
            (object) [
                'content' => 'I have appointed Arshameh from TAG Properties LLC as my property letting agent in Dubai now for 2 years, and the service leave is beyond words, exemplary !! I have found her to be very professional, knowledgeable, attentive to details and most importantly someone I trust is wholeheartedly to look after my property.  She / TAG Properties are in my view the best agents in Dubai. I would highly recommend anyone looking to rent / sell their properties to contact Arshameh, she is the best…… Thank you Arshameh for all your wonderful support as always.',
                'name' => 'Ishfaq khan',
                'designation' => ''
            ],
            (object) [
                'content' => 'Arshameh is a blessing to work with. Follows up continuously on your ask and gives you the right market advice without considering her own benefit. Got me my first property and never failed to astonish me in the way she works.. if you ever think about property investment, trust me Arshameh is the right person',
                'name' => 'Akram Karoom',
                'designation' => ''
            ],
            (object) [
                'content' => 'I would like to express my sincere gratitude to the entire team at TAG Properties, Specifically Ms. Arshameh . I bought my first property in Dubai through her and i must say She is honest , punctual, always offers an informed opinion. Not pushy at all and most importantly navigates the whole process for you . Clearly she is a professional. Thank you for your service.',
                'name' => 'HABIBI',
                'designation' => ''
            ],
            (object) [
                'content' => 'The best Realstate that I worked with , they are honest and reliable , they gave me all the information about dubai market and Realstate . They treated me as a friend not a customer.',
                'name' => 'Shermin Bayazidi',
                'designation' => ''
            ],
        ];
        $local_title = 'Home';
        return view('website.index' , compact('units', 'features' ,'developers', 'projectsCount', 'unitsCount', 'blogs', 'propertyTypes', 'propertyPurposes', 'testimonies', 'propertyTypeIcons', 'local_title'));
    }

    public function holding()
    {
        return view('website.holding');
    }

    public function contact()
    {
        $local_title = __('Let\'s Connect');
        $local_description = 'We\'re here to help! Reach out to TAG Properties for any inquiries, assistance, or to start your real estate journey.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.contact', compact('local_title', 'local_description', 'breadcrumbs'));
    }

    public function sendContact(){
        $validator = request()->validate([
            'mailer.name'          => ['required'],
            'mailer.phone'         => ['required'],
            'mailer.email'         => ['required'],
            'mailer.message'       => ['required'],
            // 'g-recaptcha-response'  => ['required', new ReCaptchaV3('submitMessage')],
        ]);
        $user = null;
        if (config('panel.create_lead_getHelp')){
            DashboardHelper::createLead(request()->get('mailer'), 'Website - Contact');
        }

        AuditLog::create([
            'description'  => 'create',
            'subject_id'   => 0,
            'subject_type' => SendContact::class,
            'user_id'      => Auth()->user->id ?? 0,
            'properties'   => request()->get('mailer'),
            'host'         => request()->ip() ?? null,
        ]);

        $user = User::firstOrCreate(['email' => config('panel.contact_receiver')]);
       
        if (request()->get('mailer')['email'] && request()->get('mailer')['message']){
            Notification::send($user, new SendContact(request()->get('mailer')));
            return back()->with('success', __('Your request was sent successfully. We will contact you soon.'));
        }else{
            return back()->with('danger', __('Invalid data! try again.'));
        }
        
       
        
    }

    public function about()
    {
        $local_title = __('Who We Are');
        $local_description = 'We make strategies, design & development to create valuable products.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];
        return view('website.about', compact('local_title', 'local_description', 'breadcrumbs'));
    }

    public function projects()
    {
        $local_title = __('Projects');
        $local_description = 'We make strategies, design & development to create valuable products.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.projects', compact('local_title', 'local_description', 'breadcrumbs'));
    }

    public function propertyShow()
    {
        return view('website.property-single');
    }

    public function developersShow(Developer $developer){
        $recentProperties = Unit::latest()->with('media', 'project' , 'tags' , 'installments' , 'floors' , 'places')->where('published' , 1)->get()->take(5);

        if(auth()->user()){
            $user = auth()->user();
            $favorites = $user->favorites()->pluck('id')->toArray();
        }else{
            $favorites = [];
        }
        $title = $developer->name . ' | ';
        $local_title = $developer->name;
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => __('Developers'), 'url' => route('developers.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.developers.developer_details', compact('favorites', 'developer', 'recentProperties', 'title', 'local_title', 'breadcrumbs'));
    //     return view('website.property-single');developer_details.blade
    }

    public function developers()
    {
        $local_title = __('Our Trusted Partners');
        $local_description = 'Collaborating with Industry-Leading Developers to Shape the Future of Real Estate.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => __('Developers'), 'url' => route('developers.index')];
        if (request()->query('city')){
            $_city = City::where('id', request()->query('city'))->first();
            $breadcrumbs[] = ['label' => $_city->name];
        }

        $query = Developer::orderBy('order')->orderBy('name');

        if (request()->query('city')){
            $query->whereRelation('cities', 'id', request()->query('city'));
        }

        $developers = $query->get();

        // if(request()->has('name') && request()->get('name')){
        //     $query->where('name', 'like', '%'.request()->get('name').'%');  
        // }

        // if(request()->has('description') && request()->get('description')){
        //     $query->where('description', 'like', '%'.request()->get('description').'%');  
        // }
        
        // $developers = $query->get();

        return view('website.developers', compact(  'local_title', 'local_description', 'breadcrumbs', 'developers'));
    }

    public function careers()
    {
        $local_title = __('Careers');
        $local_description = 'We make strategies, design & development to create valuable products.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];
        return view('website.careers', compact('local_title', 'local_description', 'breadcrumbs') );
    }

    public function questions()
    {
        $local_title = __('Freequenly Ask Question');
        $local_description = 'We make strategies, design & development.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.faq', compact('local_title', 'local_description', 'breadcrumbs'));
    }
}
