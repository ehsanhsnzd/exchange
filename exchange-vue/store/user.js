import { execute } from '~/utils/methods/publicScripts'

export const state = () => ({
    book: []
})


export const actions = {
    register(ctx, data) {
        return execute('post', '/user/register',data);
    },
    login(ctx, data) {
      return execute('post', '/user/login',data);
    },
    profile(ctx, data) {
        return execute('get', '/user');
    },
    balance(ctx, data) {
        return execute('post', `/user/balance`);
    },
    buy(ctx,data) {
        return execute('get', '/buy/'+data.from+'/'+data.to);
    },
    sell(ctx, data) {
        return execute('get', '/sell/'+data.from+'/'+data.to);
    },
    setBuy(ctx,data) {
        return execute('post', '/buy',data);
    },
    setSell(ctx, data) {
        return execute('post', '/sell',data);
    },
    history(ctx, data) {
        return execute('get', '/history',data);
    },
    update(ctx, data) {
    return execute('put', '/user',data);
    },
}
