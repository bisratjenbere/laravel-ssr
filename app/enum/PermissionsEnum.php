<?php

namespace App\enum;

enum PermissionsEnum:string
{
    case ManageFeatures ='manage-features';
    case manageUsers = 'manage-users';
    case manageComments = 'manage-comments';
    case UpvoteDownvote = 'upvote-downvote';


}
