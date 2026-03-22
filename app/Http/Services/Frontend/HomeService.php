<?php


namespace App\Http\Services\Frontend;

use App\Models\Event;
use App\Models\JobPost;
use App\Models\Membership;
use App\Models\News;
use App\Models\Notice;
use App\Models\PhotoGallery;
use App\Models\Story;
use App\Models\User;
use App\Traits\ResponseTrait;

class HomeService
{
    use ResponseTrait;

    public function getUpcomingEvent()
    {
        $upcomingEvents = Event::where('events.tenant_id', getTenantId())->where('date', '>', now())->orderBy('date', 'ASC')->where('status', STATUS_ACTIVE)->with('category')->get();
        return $upcomingEvents;
    }
    public function getPhotoGalleries()
    {
        $photoGallery = PhotoGallery::where('photo_galleries.tenant_id', getTenantId())->where('status', STATUS_ACTIVE)->get();
        return $photoGallery;
    }

    public function getAlumni($limit)
    {
        return User::where('users.tenant_id', getTenantId())->where(['users.status' => STATUS_ACTIVE])
            ->join('alumnus', 'users.id', '=', 'alumnus.user_id')
            ->leftJoin('classes as final_class', 'final_class.id', '=', 'alumnus.final_class_id')
            ->leftJoin('houses as final_house', 'final_house.id', '=', 'alumnus.final_house_id')
            ->orderBy('users.created_at', 'DESC')
            ->select('users.name', 'users.id', 'users.image', 'final_class.name as final_class_name', 'final_house.name as final_house_name')
            ->paginate($limit);
    }

    public function getEvent($limit)
    {
        return Event::where('events.tenant_id', getTenantId())->where('status', STATUS_ACTIVE)->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function getNews($limit)
    {
        return News::where('news.tenant_id', getTenantId())->where('status', STATUS_ACTIVE)->with(['category', 'author'])->orderBy('id', 'DESC')->paginate($limit);
    }

    public function getNotice($limit)
    {
        return Notice::where('notices.tenant_id', getTenantId())->where('status', STATUS_ACTIVE)->with(['category'])->orderBy('id', 'DESC')->paginate($limit);
    }

    public function getMembership()
    {
        return Membership::where('membership_plans.tenant_id', getTenantId())->where('status', STATUS_ACTIVE)->orderBy('id', 'DESC')->get();
    }

    public function getJob($limit)
    {
        return JobPost::where('job_posts.tenant_id', getTenantId())->where('status', JOB_STATUS_APPROVED)->orderBy('id', 'desc')->paginate($limit);
    }

    public function getStories($limit)
    {
        return Story::where('stories.tenant_id', getTenantId())->where('status', STATUS_ACTIVE)->orderBy('id', 'desc')->with('user')->paginate($limit);
    }


    public function getPhotoGalleriesWithFilter($decade = null)
    {
        $query = PhotoGallery::where('photo_galleries.tenant_id', getTenantId())
            ->where('status', STATUS_ACTIVE);

        if ($decade) {
            $query->where('decade', $decade);
        }

        return $query->orderBy('id', 'DESC')->get();
    }

    public function getGalleryDecades()
    {
        return PhotoGallery::where('tenant_id', getTenantId())
            ->where('status', STATUS_ACTIVE)
            ->whereNotNull('decade')
            ->distinct()
            ->orderBy('decade', 'desc')
            ->pluck('decade');
    }
}
