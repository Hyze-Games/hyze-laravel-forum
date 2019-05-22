import Group from './../Group';

export default class PostPolicy {
    // static create(user) {
    //     return user.role === 'editor';
    // }

    static destroy(user, post) {
        return user.id === post.author.id || Group[user.highest_group.key].isSameOrHigher(Group.MANAGER);
    }

    static edit(user, post) {
        return user.id === post.author.id || Group[user.highest_group.key].isSameOrHigher(Group.MANAGER);
    }

    static reply(user, post) {
        return !post.closed
    }
}