export const actions = {
    dashToDot: (string) => {
        if(string) {
            return string.replace(/-/gi, ".");
        }
    }
};

export const formatter = (action, ...args) => {
    return actions[action](...args);
};
