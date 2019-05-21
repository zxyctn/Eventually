function updateChoice(val, event_id, user) {
    $.ajax({
        type: "GET",
        url: "updateChoice.php",
        data: { value: val, event: event_id, user_id: user }
    }).done(function (msg) {
        location.reload();
    });
}

function updateProfile(user_id) {
    var fname = document.getElementById('firstName').value,
        lname = document.getElementById('lastName').value,
        email = document.getElementById('userEmail').value,
        pass = document.getElementById('userPassword').value,
        birthday = document.getElementById('userBirthDate').value,
        phone_no = document.getElementById('phoneNo').value,
        address = document.getElementById('address').value;

    $.post('updateProfile.php', {
        user_id: user_id,
        firstname: fname,
        lastname: lname,
        email: email,
        password: pass,
        birthday: birthday,
        phone_no: phone_no,
        address: address
    }, function () {
        console.log("updated profile successfully");
        location.reload();
    });
}

function publicGroupInsert(group_id, user_id) {
    $.post('publicGroupInsert.php', {
        group_id: group_id,
        user_id: user_id
    }, function () {
        console.log("attended public group successfully");
        location.reload();
    });
}

function privateGroupInsert(group_id, user_id) {
    $.post('privateGroupInsert.php', {
        group_id: group_id,
        user_id: user_id
    }, function () {
        console.log("requested private group successfully");
        location.reload();
    });
}

function deleteGroup(group) {
    $.post('deleteGroup.php', {
        group_id: group
    }, function () {
        console.log("deleted group successfully");
        window.location.replace("index.php");
    });
}

function deleteEvent(event) {
    $.post('deleteEvent.php', {
        event_id: event
    }, function () {
        console.log("deleted event successfully");
        window.location.replace("index.php");
    });
}

function addReply(c_id_Replied, content) {
    $.post('addReply.php', {
        c_id_Replied: c_id_Replied,
        content: content
    }, function () {
        console.log("added reply successfully");
        location.reload();
    });
}

function addFriend(user1, user2) {
    $.post('addFriend.php', {
        user_id1: user1,
        user_id2: user2
    }, function () {
        console.log("added friend successfully");
        location.reload();
    });
}

function acceptUser(group_id, admin_id, user_id) {
    $.post('acceptUser.php', {
        group_id: group_id,
        admin_id: admin_id,
        user_id: user_id
    }, function () {
        console.log("accepted user successfully");
        location.reload();
    });
}

function rejectUser(group_id, admin_id, user_id) {
    $.post('rejectUser.php', {
        group_id: group_id,
        admin_id: admin_id,
        user_id: user_id
    }, function () {
        console.log("accepted user successfully");
        location.reload();
    });
}

function removeFriend(user1, user2) {
    $.post('removeFriend.php', {
        user_id1: user1,
        user_id2: user2
    }, function () {
        console.log("removed friend successfully");
        location.reload();
    });
}
function acceptInvite(group, user, admin) {
    $.post('acceptInvite.php', {
        group_id: group,
        user_id: user,
        admin_id: admin,
        status: 'coming'
    }, function () {
        console.log("accepted invite successfully");
        location.reload()
    });
}

function rejectInvite(group, user, admin) {
    $.post('rejectInvite.php', {
        group_id: group,
        user_id: user,
        admin_id: admin,
        status: 'not coming'
    }, function () {
        console.log("rejected invite successfully");
        location.reload()
    });
}

function makeAdmin(group_id, user_id) {
    $.post('makeAdmin.php', {
        group_id: group_id,
        user_id: user_id
    }, function () {
        console.log("made admin successfully");
        location.reload();
    });
}