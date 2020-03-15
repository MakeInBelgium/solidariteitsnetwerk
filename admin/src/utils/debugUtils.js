export const functionName = (fun) => {
  var ret = fun.toString();
  ret = ret.substr('function '.length);
  ret = ret.substr(0, ret.indexOf('('));
  return ret;
};

export const proxyAndLog = (funcToProxy) => (...args) => {
  console.log(`Proxying ${functionName(funcToProxy)}`);
  console.log(`Args: ${JSON.stringify(args, null, 2)}`);

  const returnValue = funcToProxy(...args);
  console.log(`Return Value: ${JSON.stringify(returnValue, null, 2)}`);

  return returnValue;
};
