<?php

namespace Sfneal\Users\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Sfneal\Address\Models\Address;
use Sfneal\Models\AbstractAuthenticatable;
use Sfneal\Scopes\OrderScope;
use Sfneal\Users\Builders\UserBuilder;
use Sfneal\Users\Scopes\UserActiveScope;
use Sfneal\Currency\FormatDollars;

class User extends AbstractAuthenticatable
{
    // todo: refactor status to use Status model?
//    use HasCustomCasts;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Global scopes
        static::addGlobalScope(new UserActiveScope());
        static::addGlobalScope(new OrderScope('last_name', 'asc'));
    }

    protected $dates = ['deleted_at'];
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'first_name',
        'middle_name',
        'last_name',
        'nickname',
        'nickname_preferred',
        'title',
        'suffix',
        'email',
        'phone_work',
        'phone_mobile',
        'fax',
        'website',
        'bio',
        'username',
        'password',
        'status',
        'rate',
        'plan_management_buckets',
    ];

    /**
     * The attributes that should be hidden from arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

//    /**
//     * The attributes that should type cast.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'bio' => NewlineCast::class,
//        'plan_management_buckets' => 'array',
//    ];

//    /**
//     * @var array Events to be dispatched after certain events
//     */
//    protected $dispatchesEvents = [
//        'updated' => UserUpdatedEvent::class,
//        'deleted' => DeletedFileModelsParentEvent::class,
//    ];

    /**
     * Query Builder.
     * @param $query
     * @return UserBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new UserBuilder($query);
    }

    /**
     * Custom User query Builder.
     *
     * @return UserBuilder|Builder
     */
    public static function query(): UserBuilder
    {
        return parent::query();
    }

    /**
     * User's 'role' relationship.
     *
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

//    /**
//     * Tasks belonging to the User.
//     *
//     * @return HasMany
//     */
//    public function tasks()
//    {
//        return $this->hasMany(Task::class, 'user_id', 'id')->orderBy('updated_at', 'desc');
//    }
//
//    /**
//     * Projects that the User is a team member of.
//     *
//     * @return BelongsToMany
//     */
//    public function projects()
//    {
//        return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id')->with(['status']);
//    }
//
//    /**
//     * Comment created by the user.
//     *
//     * @return HasMany
//     */
//    public function comments()
//    {
//        return $this->hasMany(ProjectComment::class, 'user_id', 'id')->orderBy('created_at', 'desc');
//    }
//
//    /**
//     * Documents uploaded by the User.
//     *
//     * @return HasMany
//     */
//    public function docs()
//    {
//        return $this->hasMany(ProjectDocument::class, 'user_id', 'id')->orderBy('created_at', 'desc');
//    }
//
//    /**
//     * Traffic tracking for a User.
//     *
//     * @return HasMany
//     */
//    public function traffic()
//    {
//        return $this->hasMany(TrackTraffic::class, 'user_id', 'id');
//    }
//
//    /**
//     * Activity tracking for a User.
//     *
//     * @return HasMany
//     */
//    public function activity()
//    {
//        return $this->hasMany(TrackActivity::class, 'user_id', 'id');
//    }
//
//    /**
//     * Task Rate History for a User.
//     *
//     * @return HasMany
//     */
//    public function rateHistory()
//    {
//        return $this->hasMany(RateHistory::class, 'user_id', 'id');
//    }
//
//    /**
//     * The image file.
//     *
//     * @return MorphOne|File
//     */
//    public function file()
//    {
//        return $this->morphOne(File::class, 'fileable');
//    }

    /**
     * User's Notification Subscriptions.
     *
     * @return HasMany
     */
    public function notificationSubscriptions()
    {
        return $this->hasMany(UserNotification::class, 'user_id', 'id');
    }

    /**
     * User's 'team' relationship - indicates user is a member of the public team.
     *
     * @return HasOne
     */
    public function team()
    {
        return $this->hasOne(Team::class, 'user_id', 'id');
    }

    /**
     * User's address.
     *
     * @return MorphOne|Address
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * Determine if a User has a particular 'role_id'.
     *
     * @param int $role_id
     * @return bool
     */
    public function isRoleId(int $role_id): bool
    {
        return $this->role_id == $role_id;
    }

    /**
     * Determine if a User has a particular 'role name'.
     *
     * @param string $role
     * @return bool
     */
    public function isRole(string $role): bool
    {
        return strtolower($this->role->name) == strtolower($role);
    }

    /**
     * Determine if a User has an 'admin' role.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isRoleId(3);
    }

    /**
     * Determine if a User has an 'employee' role.
     *
     * @return bool
     */
    public function isEmployee(): bool
    {
        return $this->isRoleId(1);
    }

    /**
     * Determine if a User has an 'contractor' role.
     *
     * @return bool
     */
    public function isContractor(): bool
    {
        return $this->isRoleId(2);
    }

    /**
     * Determine if a User is 'active'.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status == 1;
    }

    /**
     * Determine if a User's $nickname is preferred over their $first_name.
     *
     * @return bool
     */
    public function isNicknamePreferred(): bool
    {
        return $this->nickname_preferred == 1;
    }

    /**
     * Determine if the current user is permitted to take actions on plans in the this bucket.
     *
     * @param string $bucket
     * @return bool
     */
    public function isBucketPermitted(string $bucket)
    {
        return in_array($bucket, $this->permitted_buckets);
    }

    /**
     * Retrieve a User's initials.
     *
     * @return string
     */
    public function getInitialsAttribute()
    {
        return implodeFiltered('', collect([
            $this->first_name,
            $this->middle_name,
            $this->last_name,
        ])->map(function ($name) {
            return substr($name, 0, 1);
        })->toArray());
    }

    /**
     * Retrieve a Plan Review ID for displaying a plans.plan.show modal.
     *
     * @param int $review_id
     * @return int
     */
    public function validatePlanReviewRequest(int $review_id)
    {
        // Determine what bucket permissions are being checked
        if ($review_id == 1) {
            $bucket = 'review';
        } elseif ($review_id > 1) {
            $bucket = 'complete';
        }

        // Confirm bucket is requested and permitted
        if (isset($bucket) && $this->isBucketPermitted($bucket)) {
            return $review_id;
        } else {
            return 0;
        }
    }

    /**
     * Get the AWS S3 file upload directory for an Inquiry model by retrieving the table name and primary key.
     *
     * @param string $base_dir
     * @return string
     */
    public function getUploadDirectory($base_dir = 'images'): string
    {
        return $base_dir.'/'.str_replace('_', '-', $this->getTable()).'/'.$this->getKey();
    }

    /**
     * Get the 'city_state' attribute.
     *
     * @return string
     */
    public function getCityStateAttribute()
    {
        return $this->address->city_state ?? null;
    }

    /**
     * Set the 'password' attribute.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        if (! empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

//    /**
//     * Get a User's permitted plan management buckets.
//     *
//     * @return array|mixed
//     */
//    public function getPermittedBucketsAttribute()
//    {
//        if (isset($this->plan_management_buckets)) {
//            return $this->plan_management_buckets;
//        } else {
//            return array_keys(PlanManagement::buckets());
//        }
//    }

    /**
     * Mutate the 'middle_name' attribute.
     *
     * @param string|null $value
     */
    public function setMiddleNameAttribute(string $value = null)
    {
        if (! is_null($value)) {
            // Remove leading & trailing whitespace
            $middle_name = trim($value);

            // Append '.' to the middle name if's a single letter
            $this->attributes['middle_name'] = strlen($middle_name) == 1 ? "{$middle_name}." : $middle_name;
        }
    }

    /**
     * Retrieve the User's name (first & last).
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        // Use nickname instead of first if it is set & preferred
        $first = (isset($this->nickname) && $this->isNicknamePreferred()) ? $this->nickname : $this->first_name;

        // Return concatenated name
        return "{$first} {$this->last_name}";
    }

    /**
     * Retrieve the User's full name with middle initial.
     *
     * @return string
     */
    public function getNameFullAttribute(): string
    {
        $name = $this->first_name;
        if ($this->middle_name) {
            $name .= ' '.$this->middle_name;
        }

        return "{$name} {$this->last_name}";
    }

    /**
     * Retrieve the User's name with their suffix.
     *
     * @return string
     */
    public function getNameSuffixAttribute(): string
    {
        return $this->name_full.($this->suffix ? ", {$this->suffix}" : '');
    }

    /**
     * Get the 'list_name' attribute.
     *
     * @return string
     */
    public function getListNameAttribute()
    {
        return implode(', ', array_reverse(explode(' ', $this->name)));
    }

    /**
     * Get the 'name_link' attribute that returns a url to the User's team.show page.
     *
     * @return string
     */
    public function getNameLinkAttribute()
    {
        return '<a href="'.route('user.show', ['user'=>$this->id]).'">'.$this->name.'</a>';
    }

    /**
     * Retrieve the User's 'address1' attribute.
     *
     * @return mixed
     */
    public function getAddress1Attribute()
    {
        return $this->address->address_1 ?? null;
    }

    /**
     * Retrieve the User's 'address2' attribute.
     *
     * @return mixed
     */
    public function getAddress2Attribute()
    {
        return $this->address->address_2 ?? null;
    }

    /**
     * Retrieve the User's 'city' attribute.
     *
     * @return mixed
     */
    public function getCityAttribute()
    {
        return $this->address->city ?? null;
    }

    /**
     * Retrieve the User's 'state' attribute.
     *
     * @return mixed
     */
    public function getStateAttribute()
    {
        return $this->address->state ?? null;
    }

    /**
     * Retrieve the User's 'zip' attribute.
     *
     * @return mixed
     */
    public function getZipAttribute()
    {
        return $this->address->zip ?? null;
    }

    /**
     * Retrieve the User's image path if an image exists.
     *
     * @return string|null
     */
    public function getImageAttribute()
    {
        return $this->file->path ?? null;
    }

    /**
     * Retrieve an email link.
     *
     * @return string
     */
    public function getEmailLinkAttribute(): string
    {
        return $this->email ? ('mailto:'.$this->email) : '#!';
    }

    /**
     * Retrieve a work phone link.
     *
     * @return string
     */
    public function getPhoneWorkLinkAttribute(): string
    {
        return $this->phone_work ? ('tel:'.$this->phone_work) : '#!';
    }

    /**
     * Retrieve a mobile phone link.
     *
     * @return string
     */
    public function getPhoneMobileLinkAttribute(): string
    {
        return $this->phone_mobile ? ('tel:'.$this->phone_mobile) : '#!';
    }

    /**
     * Retrieve the User's rate formatted as dollars.
     *
     * @return string
     */
    public function getRateFormattedAttribute(): string
    {
        return (! empty($this->rate)) ? '$'.FormatDollars::execute($this->rate) : '-';
    }
}